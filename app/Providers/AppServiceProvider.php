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
                // Run composer install if vendor folder does not exist
                if (!file_exists(base_path('vendor/autoload.php'))) {
                    passthru('php /usr/local/bin/composer install --no-dev --optimize-autoloader');
                }

                // Run migrations automatically
                Artisan::call('migrate', ['--force' => true]);
            } catch (\Exception $e) {
                // Optionally log exception
            }
        }
    }
}
