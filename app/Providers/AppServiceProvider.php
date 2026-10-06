<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $host = request()->getHttpHost();
        $isHttps = request()->header('x-forwarded-proto') === 'https';

        if ($isHttps || str_contains($host, 'ngrok') || str_contains($host, 'loca.lt')) {
            URL::forceScheme('https');
            Vite::useHotFile(storage_path('vite.hot'));
        } elseif ($host !== '127.0.0.1:8000' && $host !== 'localhost:8000') {
            Vite::useHotFile(storage_path('vite.hot'));
        }
    }
}
