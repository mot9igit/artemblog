<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        Carbon::setLocale("ru_RU");
        // URL::forceScheme('https');
        Paginator::defaultView('vendor.pagination.simple');
    }
}
