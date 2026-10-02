<?php

namespace App\Jobs;

use App\Mail\AnnouncementMail;
use App\Models\Announcement;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\AnnouncementNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SendAnnouncementEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Announcement $announcement) {}

    public function handle(): void
    {
        $users = match ($this->announcement->audience) {
            'customers' => User::where('role', 'customer')->get(),
            'vendors' => User::where('role', 'vendor')->get(),
            'ticket_holders' => User::whereIn('id', Ticket::whereNotNull('user_id')->distinct()->pluck('user_id'))->get(),
            default => User::all(),
        };

        foreach ($users as $user) {
            if ($user->email) {
                try {
                    Mail::to($user->email)->send(new AnnouncementMail($this->announcement));
                } catch (\Throwable $e) {
                    Log::error('Failed to send announcement email', [
                        'announcement_id' => $this->announcement->id,
                        'user_id' => $user->id,
                        'error' => $e->getMessage(),
                    ]);
                }
            }
        }

        // Send in-app notifications to users (Step 15.12)
        if ($users->isNotEmpty() && class_exists(AnnouncementNotification::class)) {
            Notification::send($users, new AnnouncementNotification($this->announcement));
        }

        $this->announcement->update(['emailed_at' => now()]);
    }
}
