<?php

namespace App\Services;

use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class TicketPdfService
{
    public function __construct(protected QrCodeService $qr) {}

    /**
     * Generate a PDF for a ticket and return the relative storage path.
     * Path format: tickets/{uuid}.pdf
     */
    public function generateForTicket(Ticket $ticket): string
    {
        $ticket->load(['ticketType.event', 'order']);

        $qrDataUri = $this->qr->dataUriForTicket($ticket);

        $pdf = Pdf::loadView('pdf.ticket', [
            'ticket'    => $ticket,
            'qrDataUri' => $qrDataUri,
        ])->setPaper([0, 0, 595, 300], 'landscape'); // 595x300 ≈ ticket-sized

        $path = "tickets/{$ticket->uuid}.pdf";

        Storage::disk('local')->put($path, $pdf->output());

        return $path;
    }
}