<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\TicketType;

class TicketController extends Controller
{
    public function index()
    {
        $event = Event::active()->upcoming()->first()
              ?? Event::active()->orderByDesc('starts_at')->first();

        $types = TicketType::active()
            ->when($event, fn ($q) => $q->where('event_id', $event->id))
            ->ordered()
            ->get();

        return view('tickets.index', compact('event', 'types'));
    }
}
