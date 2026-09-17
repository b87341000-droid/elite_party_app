<?php

namespace App\Services\Payment;

use App\Models\Order;

interface PaymentGatewayInterface
{
    /**
     * Initialize a payment. Returns array with:
     * - reference (string)
     * - redirect_url (string|null)  // null for mock (instant)
     * - status (string: pending|success|failed)
     * - raw (array)
     */
    public function initialize(Order $order): array;

    /**
     * Verify a payment by reference.
     * Returns array with:
     * - status (string: success|failed)
     * - amount (float)
     * - raw (array)
     */
    public function verify(string $reference): array;
}
