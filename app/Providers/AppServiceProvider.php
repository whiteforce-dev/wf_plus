<?php

namespace App\Providers;

use App\Models\Pipeline;
use App\Observers\StatusObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\pagination\paginator;


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
       paginator::useBootstrap();
       Pipeline::observe(StatusObserver::class);
    }
}