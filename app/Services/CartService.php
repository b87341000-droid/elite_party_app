<?php

namespace App\Services;

use App\Models\TicketType;

class CartService
{
    private const KEY = 'elite_cart';

    /**
     * Structure: [ticket_type_id => quantity, ...]
     */
    public function all(): array
    {
        return session()->get(self::KEY, []);
    }

    public function add(int $ticketTypeId, int $quantity = 1): void
    {
        $cart = $this->all();
        $cart[$ticketTypeId] = ($cart[$ticketTypeId] ?? 0) + $quantity;
        session()->put(self::KEY, $cart);
    }

    public function update(int $ticketTypeId, int $quantity): void
    {
        $cart = $this->all();

        if ($quantity <= 0) {
            unset($cart[$ticketTypeId]);
        } else {
            $cart[$ticketTypeId] = $quantity;
        }

        session()->put(self::KEY, $cart);
    }

    public function remove(int $ticketTypeId): void
    {
        $cart = $this->all();
        unset($cart[$ticketTypeId]);
        session()->put(self::KEY, $cart);
    }

    public function clear(): void
    {
        session()->forget(self::KEY);
    }

    public function count(): int
    {
        return (int) array_sum($this->all());
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    /**
     * Returns enriched cart items with model + line totals.
     */
    public function detailed(): array
    {
        $cart = $this->all();
        if (empty($cart)) {
            return [
                'items' => [],
                'subtotal' => 0,
                'total' => 0,
            ];
        }

        $types = TicketType::with('event')
            ->whereIn('id', array_keys($cart))
            ->get()
            ->keyBy('id');

        $items = [];
        $subtotal = 0;

        foreach ($cart as $id => $qty) {
            if (! isset($types[$id])) {
                continue;
            }

            $type = $types[$id];
            $lineTotal = (float) $type->online_price * $qty;

            $items[] = [
                'ticket_type' => $type,
                'quantity' => $qty,
                'unit_price' => (float) $type->online_price,
                'line_total' => $lineTotal,
            ];

            $subtotal += $lineTotal;
        }

        return [
            'items' => $items,
            'subtotal' => $subtotal,
            'total' => $subtotal,
        ];
    }
}
