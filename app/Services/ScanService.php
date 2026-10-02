<?php

namespace App\Services;

use App\Models\ScanLog;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ScanService
{
    /**
     * Scan a ticket by raw QR payload (JSON string) or ticket code.
     * Returns:
     * [
     *   'result'  => 'success' | 'duplicate' | 'invalid',
     *   'message' => string,
     *   'ticket'  => ?Ticket,
     * ]
     */
    public function scan(string $raw, ?User $scanner = null): array
    {
        $ticket = $this->resolveTicket($raw);
        $scannerId = $scanner?->id;

        // ---- INVALID ----
        if (! $ticket) {
            ScanLog::create([
                'ticket_id' => null,
                'scanned_code' => $raw,
                'result' => 'invalid',
                'scanned_by' => $scannerId,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'notes' => 'No matching ticket found.',
            ]);

            return [
                'result' => 'invalid',
                'message' => 'Invalid ticket. Not found in system.',
                'ticket' => null,
            ];
        }

        // ---- ALREADY SCANNED ----
        if ($ticket->is_scanned) {
            ScanLog::create([
                'ticket_id' => $ticket->id,
                'scanned_code' => $ticket->ticket_code,
                'result' => 'duplicate',
                'scanned_by' => $scannerId,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'notes' => 'Ticket was already scanned at '.optional($ticket->scanned_at)->toDateTimeString(),
            ]);

            return [
                'result' => 'duplicate',
                'message' => 'ALREADY USED at '.optional($ticket->scanned_at)->format('g:i A, M d').'.',
                'ticket' => $ticket,
            ];
        }

        // ---- SUCCESS ----
        DB::transaction(function () use ($ticket, $scannerId) {
            $ticket->update([
                'is_scanned' => true,
                'scanned_at' => now(),
                'scanned_by' => $scannerId,
            ]);

            ScanLog::create([
                'ticket_id' => $ticket->id,
                'scanned_code' => $ticket->ticket_code,
                'result' => 'success',
                'scanned_by' => $scannerId,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        });

        return [
            'result' => 'success',
            'message' => 'Welcome! '.strtoupper($ticket->ticketType->name ?? 'TICKET').' — valid entry.',
            'ticket' => $ticket,
        ];
    }

    /**
     * Try to resolve a ticket from raw scan input.
     * Accepts:
     * - JSON payload: {"h":"...","c":"EBP-XXXXXXXX","u":"..."}
     * - Plain ticket code: EBP-XXXXXXXX
     * - Plain QR hash
     */
    private function resolveTicket(string $raw): ?Ticket
    {
        $raw = trim($raw);

        // 1. Try JSON payload
        $decoded = json_decode($raw, true);
        if (is_array($decoded)) {
            if (! empty($decoded['h'])) {
                $ticket = Ticket::where('qr_hash', $decoded['h'])->first();
                if ($ticket) {
                    return $ticket;
                }
            }
            if (! empty($decoded['u'])) {
                $ticket = Ticket::where('uuid', $decoded['u'])->first();
                if ($ticket) {
                    return $ticket;
                }
            }
            if (! empty($decoded['c'])) {
                $ticket = Ticket::where('ticket_code', $decoded['c'])->first();
                if ($ticket) {
                    return $ticket;
                }
            }
        }

        // 2. Try ticket code
        $ticket = Ticket::where('ticket_code', strtoupper($raw))->first();
        if ($ticket) {
            return $ticket;
        }

        // 3. Try QR hash
        return Ticket::where('qr_hash', $raw)->first();
    }
}
