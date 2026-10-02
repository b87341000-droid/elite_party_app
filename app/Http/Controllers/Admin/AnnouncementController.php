<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendAnnouncementEmail;
use App\Models\Announcement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(Request $request): View
    {
        $query = Announcement::with('author')->latest();

        if ($request->filled('audience')) {
            $query->where('audience', $request->audience);
        }

        $announcements = $query->paginate(15)->withQueryString();

        $counts = [
            'all' => Announcement::count(),
            'published' => Announcement::where('is_published', true)->count(),
            'emailed' => Announcement::whereNotNull('emailed_at')->count(),
        ];

        return view('admin.announcements.index', compact('announcements', 'counts'));
    }

    public function create(): View
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateAnnouncement($request);
        $data['created_by'] = auth()->id();
        $data['send_email'] = $request->boolean('send_email');
        $data['is_published'] = $request->boolean('is_published');

        if ($data['is_published']) {
            $data['published_at'] = now();
        }

        $announcement = Announcement::create($data);

        if ($data['send_email']) {
            SendAnnouncementEmail::dispatch($announcement);
        }

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement created'.($data['send_email'] ? ' and email dispatch queued.' : '.'));
    }

    public function edit(Announcement $announcement): View
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement): RedirectResponse
    {
        $data = $this->validateAnnouncement($request);
        $data['send_email'] = $request->boolean('send_email');
        $data['is_published'] = $request->boolean('is_published');

        if ($data['is_published'] && ! $announcement->published_at) {
            $data['published_at'] = now();
        }

        $announcement->update($data);

        if ($data['send_email'] && ! $announcement->emailed_at) {
            SendAnnouncementEmail::dispatch($announcement);
        }

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement updated.');
    }

    public function destroy(Announcement $announcement): RedirectResponse
    {
        $announcement->delete();

        return back()->with('success', 'Announcement deleted.');
    }

    public function send(Announcement $announcement): RedirectResponse
    {
        SendAnnouncementEmail::dispatch($announcement);

        return back()->with('success', 'Announcement broadcast queued.');
    }

    protected function validateAnnouncement(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:200',
            'body' => 'required|string',
            'audience' => 'required|in:all,customers,vendors,ticket_holders',
            'send_email' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
        ]);
    }
}
