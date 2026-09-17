<?php

namespace App\Services\Payment;

use App\Models\Order;
use Illuminate\Support\Str;

class MockGateway implements PaymentGatewayInterface
{
    public function initialize(Order $order): array
    {
        $reference = 'MOCK_'.strtoupper(Str::random(12));

        return [
            'reference' => $reference,
            'redirect_url' => null, // instant success — no redirect
            'status' => 'success',
            'raw' => [
                'message' => 'Mock payment auto-approved in dev',
                'order' => $order->reference,
            ],
        ];
    }

    public function verify(string $reference): array
    {
        return [
            'status' => 'success',
            'amount' => 0,
            'raw' => ['message' => 'Mock verify always succeeds'],
        ];
    }
}
