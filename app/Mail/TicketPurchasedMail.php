<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketPurchasedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your ELITE BLOCK PARTY Tickets Are Ready 🎟️',
        );
    }

    public function content(): Content
    {
        $this->order->load(['tickets.ticketType']);

        return new Content(
            view: 'emails.ticket-purchased',
            with: ['order' => $this->order],
        );
    }
}
