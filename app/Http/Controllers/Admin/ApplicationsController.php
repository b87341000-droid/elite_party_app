<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VendorApplication;
use App\Services\ApplicationService;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
    public function __construct(protected ApplicationService $service) {}

    public function index(Request $request)
    {
        $query = VendorApplication::with(['user', 'reviewer'])->latest();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->paginate(20)->withQueryString();

        $counts = [
            'all'          => VendorApplication::count(),
            'pending'      => VendorApplication::where('status', 'pending')->count(),
            'approved'     => VendorApplication::where('status', 'approved')->count(),
            'rejected'     => VendorApplication::where('status', 'rejected')->count(),
            'vendors'      => VendorApplication::whereIn('type', ['food','fashion','merch','lifestyle'])->count(),
            'sponsors'     => VendorApplication::where('type', 'sponsor')->count(),
            'volunteers'   => VendorApplication::where('type', 'volunteer')->count(),
            'performers'   => VendorApplication::where('type', 'performer')->count(),
            'media'        => VendorApplication::where('type', 'media')->count(),
        ];

        return view('admin.applications.index', compact('applications', 'counts'));
    }

    public function show(VendorApplication $application)
    {
        $application->load(['user', 'reviewer']);

        return view('admin.applications.show', compact('application'));
    }

    public function approve(Request $request, VendorApplication $application)
    {
        $data = $request->validate([
            'admin_notes' => 'nullable|string|max:2000',
        ]);

        $this->service->approve($application, $request->user(), $data['admin_notes'] ?? null);

        return back()->with('success', 'Application approved and applicant notified.');
    }

    public function reject(Request $request, VendorApplication $application)
    {
        $data = $request->validate([
            'admin_notes' => 'nullable|string|max:2000',
        ]);

        $this->service->reject($application, $request->user(), $data['admin_notes'] ?? null);

        return back()->with('success', 'Application rejected and applicant notified.');
    }
}