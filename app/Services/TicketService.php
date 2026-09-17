<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Support\Str;

class TicketService
{
    /**
     * Generate individual Ticket records for a paid order.
     */
    public function generateForOrder(Order $order): int
    {
        $created = 0;

        $order->load('items.ticketType');

        foreach ($order->items as $item) {
            for ($i = 0; $i < $item->quantity; $i++) {
                Ticket::create([
                    'order_id' => $order->id,
                    'order_item_id' => $item->id,
                    'ticket_type_id' => $item->ticket_type_id,
                    'user_id' => $order->user_id,
                    'attendee_name' => $order->customer_name,
                    'attendee_email' => $order->customer_email,
                    'ticket_code' => $this->generateCode(),
                    'qr_hash' => $this->generateQrHash(),
                ]);
                $created++;
            }

            // Bump sold count
            $item->ticketType()->increment('quantity_sold', $item->quantity);
        }

        return $created;
    }

    private function generateCode(): string
    {
        do {
            $code = 'EBP-'.strtoupper(Str::random(8));
        } while (Ticket::where('ticket_code', $code)->exists());

        return $code;
    }

    private function generateQrHash(): string
    {
        return hash('sha256', Str::uuid().'|'.Str::random(64).'|'.now()->timestamp);
    }
}
