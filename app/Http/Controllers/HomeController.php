<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Event;
use App\Models\Sponsor;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $event = Event::active()->upcoming()->first()
              ?? Event::active()->orderByDesc('starts_at')->first();

        $artists = Artist::active()
            ->whereNotNull('photo')
            ->orderByDesc('is_headliner')
            ->orderBy('sort_order')
            ->limit(8)
            ->get();

        $sponsors = Sponsor::active()->ordered()->limit(12)->get();

        return view('pages.home', compact('event', 'artists', 'sponsors'));
    }
}
