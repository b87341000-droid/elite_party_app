<?php

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\ApplicationsController;
use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ScanLogsController;
use App\Http\Controllers\Admin\ScannerController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\SubscriberController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Applications
        Route::get('/applications', [ApplicationsController::class, 'index'])->name('applications.index');
        Route::get('/applications/{application}', [ApplicationsController::class, 'show'])->name('applications.show');
        Route::post('/applications/{application}/approve', [ApplicationsController::class, 'approve'])->name('applications.approve');
        Route::post('/applications/{application}/reject', [ApplicationsController::class, 'reject'])->name('applications.reject');

        // Artists
        Route::resource('artists', ArtistController::class)->except(['show']);

        // Sponsors
        Route::resource('sponsors', SponsorController::class)->except(['show']);

        // Scanner
        Route::get('/scanner', [ScannerController::class, 'index'])->name('scanner');
        Route::post('/scanner', [ScannerController::class, 'scan'])->name('scanner.scan');

        // Scan logs
        Route::get('/scan-logs', [ScanLogsController::class, 'index'])->name('scan-logs.index');

        // Blog Posts
        Route::resource('posts', PostController::class)->except(['show']);

        // Post Categories
        Route::resource('post-categories', PostCategoryController::class)->except(['show', 'create', 'edit']);

        // Announcements
        Route::resource('announcements', AnnouncementController::class)->except(['show']);
        Route::post('/announcements/{announcement}/send', [AnnouncementController::class, 'send'])->name('announcements.send');

        // Subscribers
        Route::get('/subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');
        Route::get('/subscribers/export', [SubscriberController::class, 'export'])->name('subscribers.export');
        Route::delete('/subscribers/{subscriber}', [SubscriberController::class, 'destroy'])->name('subscribers.destroy');
    });

