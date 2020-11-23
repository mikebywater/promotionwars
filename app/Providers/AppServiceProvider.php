<?php

namespace App\Providers;

use App\Repositories\Promotion\PromotionRepository;
use App\Repositories\Wrestler\WrestlerRepository;
use App\Repositories\Game\GameRepository;
use App\Services\ImportService;
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

        $this->app->bind('App\Contracts\PromotionRepository', function () {
            return new PromotionRepository();
        });

        $this->app->bind('App\Contracts\GameRepository', function () {
            return new GameRepository();
        });

        $this->app->bind('App\Services\ImportService', function () {
            return new ImportService($this->app->make('App\Contracts\WrestlerRepository'), $this->app->make('App\Contracts\PromotionRepository'));
        });
    }
}
