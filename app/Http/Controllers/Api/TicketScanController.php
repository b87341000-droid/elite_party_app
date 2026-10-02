<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ScanService;
use Illuminate\Http\Request;

class TicketScanController extends Controller
{
    public function __construct(protected ScanService $scanner) {}

    public function scan(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|max:2000',
        ]);

        $result = $this->scanner->scan($data['code'], $request->user());

        $ticket = $result['ticket'];

        return response()->json([
            'result' => $result['result'],
            'message' => $result['message'],
            'ticket' => $ticket ? [
                'code' => $ticket->ticket_code,
                'tier' => $ticket->ticketType->name ?? null,
                'attendee_name' => $ticket->attendee_name,
                'is_scanned' => $ticket->is_scanned,
                'scanned_at' => optional($ticket->scanned_at)->toIso8601String(),
            ] : null,
        ], $result['result'] === 'success' ? 200 : 422);
    }
}
