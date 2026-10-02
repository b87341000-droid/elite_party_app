<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScanLog;
use Illuminate\Http\Request;

class ScanLogsController extends Controller
{
    public function index(Request $request)
    {
        $query = ScanLog::with(['ticket', 'scanner'])->latest();

        if ($request->filled('result')) {
            $query->where('result', $request->result);
        }

        $logs = $query->paginate(50)->withQueryString();

        $counts = [
            'all' => ScanLog::count(),
            'success' => ScanLog::where('result', 'success')->count(),
            'duplicate' => ScanLog::where('result', 'duplicate')->count(),
            'invalid' => ScanLog::where('result', 'invalid')->count(),
        ];

        return view('admin.scan-logs.index', compact('logs', 'counts'));
    }
}
