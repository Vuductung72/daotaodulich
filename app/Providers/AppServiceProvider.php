<?php

namespace App\Providers;

use App\Models\Config;
use App\Observers\ConfigObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Config::observe(ConfigObserver::class);
        Paginator::useBootstrap();
    }
}
