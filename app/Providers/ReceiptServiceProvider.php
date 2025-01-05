<?php

namespace App\Providers;

use App\Http\Repositories\Receipt\ReceiptRepository;
use Illuminate\Support\ServiceProvider;

class ReceiptServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(ReceiptRepository::class, function () {
            return new ReceiptRepository();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
