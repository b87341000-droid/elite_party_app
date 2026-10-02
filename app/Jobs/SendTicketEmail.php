<?php

namespace App\Jobs;

use App\Mail\TicketPurchasedMail;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SendTicketEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Order $order) {}

    public function handle(): void
    {
        $this->order->load(['tickets.ticketType', 'tickets.order']);

        if ($this->order->tickets->isEmpty()) {
            \Log::warning('No tickets to email for order '.$this->order->reference);

            return;
        }

        $mail = Mail::to($this->order->customer_email);

        // Attach each ticket PDF from storage
        foreach ($this->order->tickets as $ticket) {
            if ($ticket->pdf_path && Storage::disk('local')->exists($ticket->pdf_path)) {
                $mail->attachData(
                    Storage::disk('local')->get($ticket->pdf_path),
                    "ELITE-Ticket-{$ticket->ticket_code}.pdf",
                    ['mime' => 'application/pdf']
                );
            }

            $ticket->update(['is_emailed' => true]);
        }

        $mail->send(new TicketPurchasedMail($this->order));
    }
}
