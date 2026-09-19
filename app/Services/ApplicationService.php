<?php

namespace App\Services;

use App\Mail\ApplicationApprovedMail;
use App\Mail\ApplicationRejectedMail;
use App\Mail\ApplicationReceivedMail;
use App\Models\User;
use App\Models\VendorApplication;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ApplicationService
{
    public function submit(array $data, ?User $user = null): VendorApplication
    {
        $documents = [];

        if (! empty($data['documents'])) {
            foreach ($data['documents'] as $file) {
                $path = $file->store('applications/' . date('Y/m'), 'local');
                $documents[] = $path;
            }
        }

        $application = VendorApplication::create([
            'user_id'       => $user?->id,
            'type'          => $data['type'],
            'business_name' => $data['business_name'] ?? null,
            'contact_name'  => $data['contact_name'],
            'email'         => $data['email'],
            'phone'         => $data['phone'],
            'description'   => $data['description'],
            'website'       => $data['website'] ?? null,
            'instagram'     => $data['instagram'] ?? null,
            'tiktok'        => $data['tiktok'] ?? null,
            'documents'     => $documents,
            'status'        => 'pending',
        ]);

        // Send confirmation email
        try {
            Mail::to($application->email)->send(new ApplicationReceivedMail($application));
        } catch (\Throwable $e) {
            \Log::error('Application received email failed', ['id' => $application->id, 'err' => $e->getMessage()]);
        }

        return $application;
    }

    public function approve(VendorApplication $application, ?User $admin = null, ?string $notes = null): void
    {
        DB::transaction(function () use ($application, $admin, $notes) {
            $application->update([
                'status'      => 'approved',
                'admin_notes' => $notes,
                'reviewed_at' => now(),
                'reviewed_by' => $admin?->id,
            ]);
        });

        // Auto-create vendor user for approved vendor-types
        if (in_array($application->type, ['food', 'fashion', 'merch', 'lifestyle']) && ! $application->user_id) {
            $this->createVendorUser($application);
        }

        try {
            Mail::to($application->email)->send(new ApplicationApprovedMail($application));
        } catch (\Throwable $e) {
            \Log::error('Approval email failed', ['id' => $application->id, 'err' => $e->getMessage()]);
        }
    }

    public function reject(VendorApplication $application, ?User $admin = null, ?string $notes = null): void
    {
        $application->update([
            'status'      => 'rejected',
            'admin_notes' => $notes,
            'reviewed_at' => now(),
            'reviewed_by' => $admin?->id,
        ]);

        try {
            Mail::to($application->email)->send(new ApplicationRejectedMail($application));
        } catch (\Throwable $e) {
            \Log::error('Rejection email failed', ['id' => $application->id, 'err' => $e->getMessage()]);
        }
    }

    protected function createVendorUser(VendorApplication $application): void
    {
        $existing = User::where('email', $application->email)->first();
        if ($existing) {
            $application->update(['user_id' => $existing->id]);
            return;
        }

        $tempPassword = Str::random(12);

        $user = User::create([
            'name'     => $application->business_name ?: $application->contact_name,
            'email'    => $application->email,
            'password' => bcrypt($tempPassword),
            'role'     => 'vendor',
            'phone'    => $application->phone,
        ]);

        $application->update(['user_id' => $user->id]);

        // Send the temp password to vendor
        try {
            Mail::to($user->email)->send(new \App\Mail\VendorCredentialsMail($user, $tempPassword));
        } catch (\Throwable $e) {
            \Log::error('Vendor credentials email failed', ['user_id' => $user->id]);
        }
    }
}