<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use App\Services\Payment\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function __construct(
        protected CartService $cart,
        protected PaymentService $payments,
    ) {}

    public function index()
    {
        if ($this->cart->isEmpty()) {
            return redirect()->route('tickets.index')->with('error', 'Your cart is empty.');
        }

        $cart = $this->cart->detailed();

        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        if ($this->cart->isEmpty()) {
            return redirect()->route('tickets.index')->with('error', 'Your cart is empty.');
        }

        $data = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:160',
            'phone' => 'required|string|max:30',
            'notes' => 'nullable|string|max:500',
        ]);

        $cart = $this->cart->detailed();

        $order = DB::transaction(function () use ($data, $cart) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'customer_name' => $data['name'],
                'customer_email' => $data['email'],
                'customer_phone' => $data['phone'],
                'subtotal' => $cart['subtotal'],
                'fees' => 0,
                'total' => $cart['total'],
                'status' => 'pending',
                'notes' => $data['notes'] ?? null,
            ]);

            foreach ($cart['items'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'ticket_type_id' => $item['ticket_type']->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'line_total' => $item['line_total'],
                ]);
            }

            return $order;
        });

        // Start payment (MockGateway → instant success)
        $result = $this->payments->start($order);

        // Clear cart now that order + payment are done
        $this->cart->clear();

        // Mock: instant success → go to success page
        if ($result['status'] === 'success') {
            return redirect()->route('checkout.success', $order->reference);
        }

        // Paystack (later): redirect to gateway
        return redirect($result['redirect_url']);
    }

    public function success(string $reference)
    {
        $order = Order::where('reference', $reference)
            ->with(['items.ticketType', 'tickets'])
            ->firstOrFail();

        return view('checkout.success', compact('order'));
    }

    public function failed()
    {
        return view('checkout.failed');
    }
}
