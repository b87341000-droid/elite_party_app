<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;

class SponsorController extends Controller
{
    public function index()
    {
        $sponsors = Sponsor::active()->ordered()->get();

        $tiers = [
            'platinum' => $sponsors->where('tier', 'platinum'),
            'gold' => $sponsors->where('tier', 'gold'),
            'silver' => $sponsors->where('tier', 'silver'),
            'partner' => $sponsors->where('tier', 'partner'),
            'media' => $sponsors->where('tier', 'media'),
        ];

        return view('pages.sponsors', compact('sponsors', 'tiers'));
    }
}
