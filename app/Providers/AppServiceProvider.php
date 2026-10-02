<?php

namespace App\Providers;

use App\Services\Payment\MockGateway;
use App\Services\Payment\PaymentGatewayInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Swap MockGateway → PaystackGateway when ready for live Paystack
        $this->app->bind(PaymentGatewayInterface::class, MockGateway::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->environment('production') || str_contains(request()->url(), 'railway.app') || request()->header('x-forwarded-proto') === 'https') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
