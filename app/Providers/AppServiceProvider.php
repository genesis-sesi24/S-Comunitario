<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Ajuste;

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
        try {
            if (Schema::hasTable('ajustes')) {
                // Share settings globally
                $settings = Ajuste::firstOrNew([], [
                    'nombre' => 'Sistema Comunitario',
                    'logo' => 'default-logo.png',
                    'logo_Cm' => 'default-logo-sm.png',
                ]);
                
                View::share('settings', $settings);
            }
        } catch (\Exception $e) {
            // Fallback if DB not ready
        }
    }
}
