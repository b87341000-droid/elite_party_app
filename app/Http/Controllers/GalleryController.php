<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;

class GalleryController extends Controller
{
    public function index()
    {
        $items = GalleryItem::published()->ordered()->get();

        return view('pages.gallery', compact('items'));
    }
}
