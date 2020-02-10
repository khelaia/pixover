<?php

namespace khelaia\pixover;

use Illuminate\Support\ServiceProvider;

class pixoverServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/pixover.php', 'pixover');

        // Register the service the package provides.
        $this->app->singleton('pixover', function ($app) {
            return new pixover;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['pixover'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/pixover.php' => config_path('pixover.php'),
        ], 'pixover.config');

    }
}
