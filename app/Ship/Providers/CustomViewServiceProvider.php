<?php

namespace App\Ship\Providers;

use Illuminate\Support\ServiceProvider;

class CustomViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(app_path('Ship/CustomContainer/Views'), 'customcontainer');
    }
}
