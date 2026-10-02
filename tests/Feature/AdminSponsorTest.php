<?php

namespace Tests\Feature;

use App\Models\Sponsor;
use App\Models\User;
use Database\Seeders\SponsorSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminSponsorTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected User $customer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->customer = User::factory()->create([
            'role' => 'customer',
        ]);
    }

    public function test_guest_cannot_access_admin_sponsors(): void
    {
        $response = $this->get(route('admin.sponsors.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_customer_cannot_access_admin_sponsors(): void
    {
        $response = $this->actingAs($this->customer)->get(route('admin.sponsors.index'));
        $response->assertStatus(403);
    }

    public function test_admin_can_view_sponsors_index_and_tier_filter(): void
    {
        Sponsor::create(['name' => 'Sponsor Platinum', 'tier' => 'platinum', 'sort_order' => 1, 'is_active' => true]);
        Sponsor::create(['name' => 'Sponsor Gold', 'tier' => 'gold', 'sort_order' => 2, 'is_active' => true]);

        $response = $this->actingAs($this->admin)->get(route('admin.sponsors.index'));
        $response->assertStatus(200);
        $response->assertSee('Sponsor Platinum');
        $response->assertSee('Sponsor Gold');

        $filterResponse = $this->actingAs($this->admin)->get(route('admin.sponsors.index', ['tier' => 'platinum']));
        $filterResponse->assertStatus(200);
        $filterResponse->assertSee('Sponsor Platinum');
        $filterResponse->assertDontSee('Sponsor Gold');
    }

    public function test_seeded_sponsors_and_tier_counts(): void
    {
        $this->seed(SponsorSeeder::class);

        $response = $this->actingAs($this->admin)->get(route('admin.sponsors.index'));
        $response->assertStatus(200);

        $counts = $response->viewData('counts');
        $this->assertEquals(count(Sponsor::all()), $counts['all']);
        $this->assertEquals(3, $counts['platinum']);
        $this->assertEquals(3, $counts['gold']);
        $this->assertEquals(3, $counts['silver']);
        $this->assertEquals(0, $counts['partner']);
        $this->assertEquals(3, $counts['media']);

        $platinumResponse = $this->actingAs($this->admin)->get(route('admin.sponsors.index', ['tier' => 'platinum']));
        $platinumResponse->assertStatus(200);
        $this->assertCount(3, $platinumResponse->viewData('sponsors'));
    }

    public function test_create_and_edit_forms_render_successfully(): void
    {
        $createResponse = $this->actingAs($this->admin)->get(route('admin.sponsors.create'));
        $createResponse->assertStatus(200);
        $createResponse->assertSeeText('ADD SPONSOR');

        $sponsor = Sponsor::create([
            'name' => 'Test Edit Sponsor',
            'tier' => 'gold',
            'website' => 'https://example.com',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        $editResponse = $this->actingAs($this->admin)->get(route('admin.sponsors.edit', $sponsor));
        $editResponse->assertStatus(200);
        $editResponse->assertSee('Test Edit Sponsor');
        $editResponse->assertSee('https://example.com');
    }

    public function test_admin_can_create_sponsor_with_logo(): void
    {
        Storage::fake('public');

        $logo = UploadedFile::fake()->image('sponsor_logo.png', 200, 200);

        $response = $this->actingAs($this->admin)->post(route('admin.sponsors.store'), [
            'name' => 'Red Bull Tech',
            'tier' => 'platinum',
            'website' => 'https://redbull.com',
            'description' => 'Energy partner',
            'sort_order' => 1,
            'is_active' => 1,
            'logo' => $logo,
        ]);

        $response->assertRedirect(route('admin.sponsors.index'));
        $response->assertSessionHas('success');

        $sponsor = Sponsor::where('name', 'Red Bull Tech')->first();
        $this->assertNotNull($sponsor);
        $this->assertEquals('platinum', $sponsor->tier);
        $this->assertNotNull($sponsor->logo);
        Storage::disk('public')->assertExists($sponsor->logo);

        // Check public sponsors page displays it
        $publicResponse = $this->get(route('sponsors'));
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('Red Bull Tech');

        // Check homepage marquee displays it
        $homeResponse = $this->get(route('home'));
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('Red Bull Tech');
    }

    public function test_admin_can_update_sponsor_and_replace_logo(): void
    {
        Storage::fake('public');

        $oldLogo = UploadedFile::fake()->image('old_logo.png');
        $oldPath = $oldLogo->store('sponsors', 'public');

        $sponsor = Sponsor::create([
            'name' => 'Brand One',
            'tier' => 'gold',
            'website' => 'https://brandone.com',
            'logo' => $oldPath,
            'sort_order' => 5,
            'is_active' => true,
        ]);

        $newLogo = UploadedFile::fake()->image('new_logo.png');

        $response = $this->actingAs($this->admin)->put(route('admin.sponsors.update', $sponsor), [
            'name' => 'Brand One Premium',
            'tier' => 'platinum',
            'website' => 'https://brandone.com/new',
            'description' => 'Updated desc',
            'sort_order' => 1,
            'is_active' => 1,
            'logo' => $newLogo,
        ]);

        $response->assertRedirect(route('admin.sponsors.index'));
        $response->assertSessionHas('success');

        $sponsor->refresh();
        $this->assertEquals('Brand One Premium', $sponsor->name);
        $this->assertEquals('platinum', $sponsor->tier);
        Storage::disk('public')->assertMissing($oldPath);
        Storage::disk('public')->assertExists($sponsor->logo);
    }

    public function test_admin_can_delete_sponsor_and_cleanup_logo(): void
    {
        Storage::fake('public');

        $logo = UploadedFile::fake()->image('sponsor_to_delete.png');
        $path = $logo->store('sponsors', 'public');

        $sponsor = Sponsor::create([
            'name' => 'Delete Me Sponsor',
            'tier' => 'silver',
            'logo' => $path,
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->admin)->delete(route('admin.sponsors.destroy', $sponsor));
        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('sponsors', ['id' => $sponsor->id]);
        Storage::disk('public')->assertMissing($path);
    }
}
