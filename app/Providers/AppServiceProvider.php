<?php

namespace App\Providers;

use App\Models\About;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
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
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        View::composer(['layouts.app', 'partials.navbar', 'partials.modal-profile', 'partials.footer', 'about.index'], function ($view) {
            try {
                if (Schema::hasTable('abouts')) {
                    $about = About::first();
                    $view->with('aboutProfile', $about);
                }
            } catch (\Throwable $e) {
                // Ignore during early bootstrap/migrations
            }
        });
    }
}
