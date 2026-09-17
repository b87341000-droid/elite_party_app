<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_renders_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_about_page_renders_successfully(): void
    {
        $response = $this->get('/about');
        $response->assertStatus(200);
        $response->assertSee('ABOUT');
    }

    public function test_event_page_renders_successfully(): void
    {
        $response = $this->get('/event');
        $response->assertStatus(200);
        $response->assertSee('DETAILS');
    }

    public function test_lineup_page_renders_successfully(): void
    {
        $response = $this->get('/lineup');
        $response->assertStatus(200);
        $response->assertSee('LINE-UP');
    }

    public function test_experiences_page_renders_successfully(): void
    {
        $response = $this->get('/experiences');
        $response->assertStatus(200);
        $response->assertSee('EXPERIENCE');
    }

    public function test_gallery_page_renders_successfully(): void
    {
        $response = $this->get('/gallery');
        $response->assertStatus(200);
        $response->assertSee('GALLERY');
    }

    public function test_vendors_page_renders_successfully(): void
    {
        $response = $this->get('/vendors');
        $response->assertStatus(200);
        $response->assertSee('VENDORS');
    }

    public function test_sponsors_page_renders_successfully(): void
    {
        $response = $this->get('/sponsors');
        $response->assertStatus(200);
        $response->assertSee('PARTNERS');
    }

    public function test_contact_page_renders_successfully(): void
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertSee('GET IN');
    }

    public function test_contact_form_submission(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Adewale Johnson',
            'email' => 'adewale@example.com',
            'phone' => '+2348012345678',
            'subject' => 'VIP Table Inquiry',
            'message' => 'Hello team, I would like to inquire about VVIP table bookings for a party of 8.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', [
            'email' => 'adewale@example.com',
            'name' => 'Adewale Johnson',
            'subject' => 'VIP Table Inquiry',
        ]);
    }
}
