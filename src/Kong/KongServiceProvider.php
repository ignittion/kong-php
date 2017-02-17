<?php

namespace Ignittion\Kong;

use Illuminate\Support\ServiceProvider;

class KongServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events
     *
     */
    public function boot()
    {
        $version    = strtoupper(app()->version());

        if (strpos($version, 'LUMEN') === false) { // Laravel can only publish

            $this->publishes([
                __DIR__.'/../config/kong.php'   => config_path('kong.php'),
            ]);
        }
    }

    /**
     * Register the ServiceProvider
     *
     */
    public function register()
    {
        $this->app->singleton('kong', function ($app) {
            return new Kong(config('kong.url'), config('kong.port'));
        });
    }
}
