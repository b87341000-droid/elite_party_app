<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LineupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\VendorController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/admin/test', function () {
    return 'ADMIN AREA OK — welcome '.auth()->user()->name;
})->middleware(['auth', 'admin']);

Route::get('/vendor/test', function () {
    return 'VENDOR AREA OK — welcome '.auth()->user()->name;
})->middleware(['auth', 'vendor']);
