<?php

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Support\Facades\Hash;

test('1. home page renders with login and register links', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Log in');
    $response->assertSee('Register');
});

test('2. register screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('3. new customer can register and get redirected to dashboard', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test_checklist@test.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect('/dashboard');

    $user = User::where('email', 'test_checklist@test.com')->first();
    expect($user)->not->toBeNull();
    expect($user->isCustomer())->toBeTrue();
    expect($user->role)->toBe('customer');
});

test('5. unauthenticated user accessing admin/test is redirected to login', function () {
    $response = $this->get('/admin/test');

    $response->assertRedirect('/login');
});

test('7. customer user receives 403 on admin/test', function () {
    $user = User::factory()->create(['role' => 'customer']);

    $response = $this->actingAs($user)->get('/admin/test');

    $response->assertStatus(403);
    $response->assertSeeText('Admin access only.');
});

test('8. customer user receives 403 on vendor/test', function () {
    $user = User::factory()->create(['role' => 'customer']);

    $response = $this->actingAs($user)->get('/vendor/test');

    $response->assertStatus(403);
    $response->assertSeeText('Vendor access only.');
});

test('9 & 10. admin user can access admin/test', function () {
    $admin = User::create([
        'name' => 'Elite Admin',
        'email' => 'admin_test@eliteblockparty.com',
        'password' => Hash::make('EliteAdmin@2025'),
        'role' => 'admin',
        'phone' => '+2348000000000',
    ]);

    $response = $this->actingAs($admin)->get('/admin/test');

    $response->assertStatus(200);
    $response->assertSeeText('ADMIN AREA OK — welcome Elite Admin');
});

test('11. admin user receives 403 on vendor/test', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->get('/vendor/test');

    $response->assertStatus(403);
    $response->assertSeeText('Vendor access only.');
});

test('12 & 13. vendor user can access vendor/test', function () {
    $vendor = User::create([
        'name' => 'Test Vendor',
        'email' => 'vendor_test@eliteblockparty.com',
        'password' => Hash::make('VendorPass@2025'),
        'role' => 'vendor',
        'phone' => '+2348000000001',
    ]);

    $response = $this->actingAs($vendor)->get('/vendor/test');

    $response->assertStatus(200);
    $response->assertSeeText('VENDOR AREA OK — welcome Test Vendor');
});

test('admin seeder seeds admin and vendor correctly', function () {
    $this->seed(AdminUserSeeder::class);

    $admin = User::where('email', 'admin@eliteblockparty.com')->first();
    expect($admin)->not->toBeNull();
    expect($admin->isAdmin())->toBeTrue();
    expect(Hash::check('EliteAdmin@2025', $admin->password))->toBeTrue();

    $vendor = User::where('email', 'vendor@eliteblockparty.com')->first();
    expect($vendor)->not->toBeNull();
    expect($vendor->isVendor())->toBeTrue();
    expect(Hash::check('VendorPass@2025', $vendor->password))->toBeTrue();
});
