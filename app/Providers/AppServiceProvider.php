<?php

namespace App\Providers;

use App\Repositories\Wrestler\WrestlerRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Contracts\WrestlerRepository', function () {
            return new WrestlerRepository();
        });
    }
}
