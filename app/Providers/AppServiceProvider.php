<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (!app()->runningInConsole()) {
            try {
                // Run migrations automatically
                Artisan::call('migrate', ['--force' => true]);
            } catch (\Exception $e) {
                // Log or ignore exceptions
            }
        }
    }
}
