<?php

namespace Notano\Cruddy;

use Notano\Cruddy\Commands\Cruddy;
use Illuminate\Support\ServiceProvider;

class CruddyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Cruddy::class,
            ]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }
}
