<?php

namespace App\Services;

use App\Models\Ticket;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeService
{
    /**
     * Generate a QR PNG for a ticket and return the relative storage path.
     * Path format: qrcodes/{uuid}.png
     */
    public function generateForTicket(Ticket $ticket): string
    {
        $path = "qrcodes/{$ticket->uuid}.png";

        // Full payload the scanner will read
        $payload = json_encode([
            'h' => $ticket->qr_hash,
            'c' => $ticket->ticket_code,
            'u' => $ticket->uuid,
        ]);

        $png = QrCode::format('png')
            ->size(400)
            ->margin(2)
            ->errorCorrection('H')
            ->generate($payload);

        Storage::disk('local')->put($path, $png);

        return $path;
    }

    /**
     * Absolute filesystem path for a stored QR.
     */
    public function absolutePath(string $relativePath): string
    {
        return storage_path('app/'.$relativePath);
    }

    /**
     * Base64 data URI (for inline embedding in PDFs without filesystem).
     */
    public function dataUriForTicket(Ticket $ticket): string
    {
        $payload = json_encode([
            'h' => $ticket->qr_hash,
            'c' => $ticket->ticket_code,
            'u' => $ticket->uuid,
        ]);

        $png = QrCode::format('png')
            ->size(400)
            ->margin(2)
            ->errorCorrection('H')
            ->generate($payload);

        return 'data:image/png;base64,'.base64_encode($png);
    }
}
