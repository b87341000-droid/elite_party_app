<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\TicketType;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'revenue'         => Order::paid()->sum('total'),
            'orders_today'    => Order::paid()->whereDate('paid_at', today())->count(),
            'tickets_sold'    => Ticket::count(),
            'tickets_scanned' => Ticket::where('is_scanned', true)->count(),
            'customers'       => User::where('role', 'customer')->count(),
        ];

        $recentOrders = Order::with('items.ticketType')
            ->latest()
            ->limit(8)
            ->get();

        $recentScans = Ticket::with('ticketType')
            ->where('is_scanned', true)
            ->latest('scanned_at')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'recentScans'));
    }
}