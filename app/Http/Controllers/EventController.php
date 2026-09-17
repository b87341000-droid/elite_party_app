<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $event = Event::active()->upcoming()->first()
              ?? Event::active()->orderByDesc('starts_at')->first();

        return view('pages.event-details', compact('event'));
    }
}
