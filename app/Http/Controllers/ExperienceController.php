<?php

namespace App\Http\Controllers;

use App\Models\Experience;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::active()->ordered()->get();

        return view('pages.experiences', compact('experiences'));
    }
}
