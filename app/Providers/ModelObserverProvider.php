<?php

namespace App\Providers;

use App\Observers\UserModelObserver;
use App\User;
use Illuminate\Support\ServiceProvider;

class ModelObserverProvider extends ServiceProvider
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
        //
        User::observe(UserModelObserver::class);
    }
}
