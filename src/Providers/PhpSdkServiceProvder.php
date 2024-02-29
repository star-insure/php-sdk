<?php

namespace StarInsure\PhpSdk\Providers;

use Illuminate\Support\ServiceProvider;

class PhpSdkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Register singletons for our formatters
        $this->app->singleton(\StarInsure\PhpSdk\Contracts\MoneyFormatter::class, function ($app) {
            return new \StarInsure\PhpSdk\Formatters\MoneyFormatter;
        });

        $this->app->singleton(\StarInsure\PhpSdk\Contracts\DateFormatter::class, function ($app) {
            return new \StarInsure\PhpSdk\Formatters\DateFormatter;
        });

        $this->app->singleton(\StarInsure\PhpSdk\Contracts\DateTimeFormatter::class, function ($app) {
            return new \StarInsure\PhpSdk\Formatters\DateTimeFormatter;
        });
    }
}
