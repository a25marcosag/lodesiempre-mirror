<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;

public function boot(): void
{
    if (app()->environment('production')) {
        try {
            Artisan::call('migrate', ['--force' => true]);
        } catch (\Exception $e) {
            
        }
    }
}
