<?php

namespace App\Http\Controllers;

use App\Models\Artist;

class LineupController extends Controller
{
    public function index()
    {
        $artists = Artist::active()->ordered()->get();

        $headliners = $artists->where('is_headliner', true);
        $performers = $artists->where('is_headliner', false);

        return view('pages.lineup', compact('artists', 'headliners', 'performers'));
    }
}
