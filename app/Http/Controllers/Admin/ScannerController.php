<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ScanService;
use Illuminate\Http\Request;

class ScannerController extends Controller
{
    public function __construct(protected ScanService $scanner) {}

    public function index()
    {
        return view('admin.scanner');
    }

    public function scan(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|max:2000',
        ]);

        $result = $this->scanner->scan($data['code'], $request->user());

        return response()->json([
            'result'  => $result['result'],
            'message' => $result['message'],
            'ticket'  => $result['ticket'] ? [
                'code'          => $result['ticket']->ticket_code,
                'tier'          => $result['ticket']->ticketType->name ?? null,
                'attendee_name' => $result['ticket']->attendee_name,
                'scanned_at'    => optional($result['ticket']->scanned_at)->format('g:i A, M d'),
            ] : null,
        ], $result['result'] === 'success' ? 200 : 422);
    }
}