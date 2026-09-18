<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ScanLogsController;
use App\Http\Controllers\Admin\ScannerController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Scanner
        Route::get('/scanner', [ScannerController::class, 'index'])->name('scanner');
        Route::post('/scanner', [ScannerController::class, 'scan'])->name('scanner.scan');

        // Scan logs
        Route::get('/scan-logs', [ScanLogsController::class, 'index'])->name('scan-logs.index');
    });