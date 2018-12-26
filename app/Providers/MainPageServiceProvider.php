<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MainPageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('mainPage', 'App\Repository\MainPage');
    }
}
