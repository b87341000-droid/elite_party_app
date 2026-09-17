<?php

namespace App\Services\Payment;

use App\Models\Order;
use App\Models\Payment;
use App\Services\TicketService;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    public function __construct(
        protected PaymentGatewayInterface $gateway,
        protected TicketService $ticketService,
    ) {}

    /**
     * Start payment for an order.
     * For mock: marks paid immediately, creates tickets.
     * For paystack (later): returns redirect URL.
     */
    public function start(Order $order): array
    {
        $init = $this->gateway->initialize($order);

        $payment = Payment::create([
            'order_id' => $order->id,
            'gateway' => $this->gatewayName(),
            'gateway_reference' => $init['reference'],
            'amount' => $order->total,
            'currency' => 'NGN',
            'status' => $init['status'] === 'success' ? 'success' : 'pending',
            'gateway_response' => $init['raw'] ?? null,
            'verified_at' => $init['status'] === 'success' ? now() : null,
        ]);

        if ($init['status'] === 'success') {
            $this->markOrderPaid($order);
        }

        return [
            'payment' => $payment,
            'redirect_url' => $init['redirect_url'] ?? null,
            'status' => $init['status'],
        ];
    }

    /**
     * Verify + finalize after redirect (Paystack webhook/callback later).
     */
    public function verify(Order $order, string $reference): bool
    {
        $result = $this->gateway->verify($reference);

        if ($result['status'] === 'success') {
            Payment::where('order_id', $order->id)
                ->where('gateway_reference', $reference)
                ->update([
                    'status' => 'success',
                    'gateway_response' => $result['raw'] ?? null,
                    'verified_at' => now(),
                ]);

            $this->markOrderPaid($order);

            return true;
        }

        return false;
    }

    private function markOrderPaid(Order $order): void
    {
        DB::transaction(function () use ($order) {
            if ($order->status === 'paid') {
                return;
            }

            $order->update([
                'status' => 'paid',
                'payment_method' => $this->gatewayName(),
                'paid_at' => now(),
            ]);

            $this->ticketService->generateForOrder($order);
        });
    }

    private function gatewayName(): string
    {
        return match (true) {
            $this->gateway instanceof MockGateway => 'mock',
            default => 'paystack',
        };
    }
}
