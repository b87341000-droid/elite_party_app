<?php

namespace App\Http\Controllers;

use App\Models\TicketType;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(protected CartService $cart) {}

    public function index()
    {
        $cart = $this->cart->detailed();

        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, TicketType $ticketType)
    {
        $data = $request->validate([
            'quantity' => 'required|integer|min:1|max:'.max(1, $ticketType->max_per_order),
        ]);

        if ($ticketType->isSoldOut()) {
            return back()->with('error', 'That ticket tier is sold out.');
        }

        $this->cart->add($ticketType->id, (int) $data['quantity']);

        return redirect()->route('cart.index')
            ->with('success', "{$ticketType->name} ticket added to cart.");
    }

    public function update(Request $request, TicketType $ticketType)
    {
        $data = $request->validate([
            'quantity' => 'required|integer|min:0|max:'.max(1, $ticketType->max_per_order),
        ]);

        $this->cart->update($ticketType->id, (int) $data['quantity']);

        return back()->with('success', 'Cart updated.');
    }

    public function remove(TicketType $ticketType)
    {
        $this->cart->remove($ticketType->id);

        return back()->with('success', 'Item removed.');
    }

    public function clear()
    {
        $this->cart->clear();

        return redirect()->route('tickets.index')->with('success', 'Cart cleared.');
    }
}
