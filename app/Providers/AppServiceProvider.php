<?php

namespace App\Providers;

use App\Models\Gallery;
use App\Observers\GalleryObserver;
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
        Gallery::observe(GalleryObserver::class);

    }
}
