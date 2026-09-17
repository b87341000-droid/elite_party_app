<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Ticket;
use App\Models\TicketType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketSystemTest extends TestCase
{
    use RefreshDatabase;

    protected Event $event;

    protected TicketType $regular;

    protected TicketType $vip;

    protected function setUp(): void
    {
        parent::setUp();

        $this->event = Event::create([
            'name' => 'Elite Block Party 2025',
            'slug' => 'elite-block-party-2025',
            'venue_name' => 'Eko Hotel Grounds',
            'venue_address' => 'Plot 1415 Adetokunbo Ademola Street',
            'city' => 'Lagos',
            'state' => 'Lagos',
            'country' => 'Nigeria',
            'starts_at' => now()->addMonth(),
            'ends_at' => now()->addMonth()->addHours(8),
            'is_active' => true,
            'tickets_on_sale' => true,
        ]);

        $this->regular = TicketType::create([
            'event_id' => $this->event->id,
            'name' => 'Regular',
            'slug' => 'regular',
            'online_price' => 12000,
            'door_price' => 17000,
            'quantity_total' => 2000,
            'quantity_sold' => 0,
            'max_per_order' => 10,
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $this->vip = TicketType::create([
            'event_id' => $this->event->id,
            'name' => 'VIP',
            'slug' => 'vip',
            'online_price' => 25000,
            'door_price' => 30000,
            'quantity_total' => 500,
            'quantity_sold' => 0,
            'max_per_order' => 6,
            'sort_order' => 2,
            'is_active' => true,
        ]);
    }

    public function test_tickets_index_page_renders_ticket_tiers(): void
    {
        $response = $this->get('/tickets');

        $response->assertStatus(200);
        $response->assertSee('Regular');
        $response->assertSee('VIP');
        $response->assertSee('12,000');
        $response->assertSee('25,000');
    }

    public function test_can_add_tickets_to_cart(): void
    {
        $response = $this->post(route('cart.add', $this->regular), [
            'quantity' => 2,
        ]);

        $response->assertRedirect(route('cart.index'));
        $response->assertSessionHas('elite_cart', [$this->regular->id => 2]);
    }

    public function test_cart_index_displays_items_and_totals(): void
    {
        $this->withSession(['elite_cart' => [$this->regular->id => 2, $this->vip->id => 1]]);

        $response = $this->get('/cart');

        $response->assertStatus(200);
        $response->assertSee('Regular');
        $response->assertSee('VIP');
        $response->assertSee('49,000'); // 12000*2 + 25000*1 = 49000
    }

    public function test_can_update_cart_quantity(): void
    {
        $this->withSession(['elite_cart' => [$this->regular->id => 2]]);

        $response = $this->patch(route('cart.update', $this->regular), [
            'quantity' => 4,
        ]);

        $response->assertRedirect();
        $this->assertEquals(4, session('elite_cart')[$this->regular->id]);
    }

    public function test_can_remove_item_from_cart(): void
    {
        $this->withSession(['elite_cart' => [$this->regular->id => 2, $this->vip->id => 1]]);

        $response = $this->delete(route('cart.remove', $this->regular));

        $response->assertRedirect();
        $this->assertArrayNotHasKey($this->regular->id, session('elite_cart', []));
        $this->assertArrayHasKey($this->vip->id, session('elite_cart', []));
    }

    public function test_full_checkout_flow_with_mock_payment(): void
    {
        $this->withSession(['elite_cart' => [$this->regular->id => 2, $this->vip->id => 1]]);

        $response = $this->post('/checkout', [
            'name' => 'Tunde Bakare',
            'email' => 'tunde.bakare@example.com',
            'phone' => '+2348099887766',
            'notes' => 'Looking forward to the drift show!',
        ]);

        $order = Order::where('customer_email', 'tunde.bakare@example.com')->first();
        $this->assertNotNull($order);
        $this->assertEquals('paid', $order->status);
        $this->assertEquals(49000, $order->total);
        $this->assertEquals('mock', $order->payment_method);

        // Assert redirected to success page
        $response->assertRedirect(route('checkout.success', $order->reference));

        // Assert OrderItems created
        $this->assertCount(2, $order->items);

        // Assert individual Ticket records created (2 regular + 1 VIP = 3 total)
        $this->assertCount(3, $order->tickets);
        $this->assertEquals(3, Ticket::where('order_id', $order->id)->count());

        foreach ($order->tickets as $ticket) {
            $this->assertStringStartsWith('EBP-', $ticket->ticket_code);
            $this->assertNotEmpty($ticket->qr_hash);
            $this->assertEquals('Tunde Bakare', $ticket->attendee_name);
        }

        // Assert Payment created
        $payment = Payment::where('order_id', $order->id)->first();
        $this->assertNotNull($payment);
        $this->assertEquals('success', $payment->status);
        $this->assertEquals('mock', $payment->gateway);

        // Assert ticket_type quantity_sold incremented
        $this->assertEquals(2, $this->regular->fresh()->quantity_sold);
        $this->assertEquals(1, $this->vip->fresh()->quantity_sold);

        // Assert cart was cleared
        $this->assertEmpty(session('elite_cart', []));

        // Follow redirect to success page
        $successResponse = $this->get(route('checkout.success', $order->reference));
        $successResponse->assertStatus(200);
        $successResponse->assertSee($order->reference);
        $successResponse->assertSee('Payment Confirmed');
        $successResponse->assertSee('Your Tickets');
    }
}
