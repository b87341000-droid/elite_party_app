<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Event;
use App\Models\Experience;
use App\Models\GalleryItem;
use App\Models\Review;
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
        $experiences = Experience::active()->ordered()->limit(6)->get();
        $galleryItems = GalleryItem::published()->ordered()->limit(8)->get();
        $reviews = Review::approved()->featured()->limit(3)->get();

        return view('pages.home', compact('event', 'artists', 'sponsors', 'experiences', 'galleryItems', 'reviews'));
    }
}
