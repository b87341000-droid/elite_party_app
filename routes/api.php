<?php

use App\Http\Controllers\Api\TicketScanController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/tickets/scan', [TicketScanController::class, 'scan'])
        ->name('api.tickets.scan');
});