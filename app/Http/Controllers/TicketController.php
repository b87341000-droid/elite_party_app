<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
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

    public function myTickets()
    {
        $tickets = Ticket::with(['ticketType.event', 'order'])
            ->where('user_id', auth()->id())
            ->orWhere('attendee_email', auth()->user()->email)
            ->latest()
            ->get();

        return view('tickets.my-tickets', compact('tickets'));
    }

    public function downloadPdf(string $uuid)
    {
        $ticket = Ticket::where('uuid', $uuid)->firstOrFail();

        // Only owner or admin can download
        $isOwner = auth()->check() && (
            $ticket->user_id === auth()->id() ||
            $ticket->attendee_email === auth()->user()->email
        );
        $isAdmin = auth()->check() && auth()->user()->isAdmin();

        abort_unless($isOwner || $isAdmin, 403);

        abort_unless($ticket->pdf_path && \Storage::disk('local')->exists($ticket->pdf_path), 404);

        return response()->download(
            storage_path('app/'.$ticket->pdf_path),
            "ELITE-Ticket-{$ticket->ticket_code}.pdf"
        );
    }
}
