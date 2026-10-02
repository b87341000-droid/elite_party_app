<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LineupController;
use App\Http\Controllers\MediaPartnerController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PerformerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SponsorApplicationController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\VendorApplicationController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VolunteerController;
use Illuminate\Support\Facades\Route;

// Public pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/event', [EventController::class, 'index'])->name('event');
Route::get('/lineup', [LineupController::class, 'index'])->name('lineup');
Route::get('/experiences', [ExperienceController::class, 'index'])->name('experiences');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/vendors', [VendorController::class, 'index'])->name('vendors');
Route::get('/sponsors', [SponsorController::class, 'index'])->name('sponsors');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Public Announcements
Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');

// Tickets
Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');

// My tickets
Route::middleware('auth')->group(function () {
    Route::get('/my-tickets', [TicketController::class, 'myTickets'])->name('tickets.mine');
});

// PDF download (auth checked in controller)
Route::get('/tickets/{uuid}/pdf', [TicketController::class, 'downloadPdf'])
    ->middleware('auth')
    ->name('tickets.pdf');

// Applications
Route::get('/vendor/apply', [VendorApplicationController::class, 'create'])->name('vendor.apply');
Route::post('/vendor/apply', [VendorApplicationController::class, 'store'])->name('vendor.apply.store');

Route::get('/sponsor/apply', [SponsorApplicationController::class, 'create'])->name('sponsor.apply');
Route::post('/sponsor/apply', [SponsorApplicationController::class, 'store'])->name('sponsor.apply.store');

Route::get('/volunteer', [VolunteerController::class, 'create'])->name('volunteer.apply');
Route::post('/volunteer', [VolunteerController::class, 'store'])->name('volunteer.apply.store');

Route::get('/perform', [PerformerController::class, 'create'])->name('performer.apply');
Route::post('/perform', [PerformerController::class, 'store'])->name('performer.apply.store');

Route::get('/media-partners', [MediaPartnerController::class, 'create'])->name('media.apply');
Route::post('/media-partners', [MediaPartnerController::class, 'store'])->name('media.apply.store');

// Shared success page
Route::view('/apply/success', 'applications.success')->name('apply.success');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{ticketType}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{ticketType}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{ticketType}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{reference}', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/failed', [CheckoutController::class, 'failed'])->name('checkout.failed');

// Newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{email}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Notifications (auth)
Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/latest', [NotificationController::class, 'latest'])->name('notifications.latest');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.read-all');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::delete('/notifications', [NotificationController::class, 'destroyAll'])->name('notifications.destroy-all');
});

require __DIR__.'/auth.php';

Route::get('/admin/test', function () {
    return 'ADMIN AREA OK — welcome '.auth()->user()->name;
})->middleware(['auth', 'admin']);

Route::get('/vendor/test', function () {
    return 'VENDOR AREA OK — welcome '.auth()->user()->name;
})->middleware(['auth', 'vendor']);
