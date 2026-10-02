<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(): View
    {
        $announcements = Announcement::published()
            ->where(function ($q) {
                $q->where('audience', 'all')
                    ->orWhereNull('audience');
            })
            ->latest('published_at')
            ->paginate(12);

        return view('pages.announcements', compact('announcements'));
    }
}
