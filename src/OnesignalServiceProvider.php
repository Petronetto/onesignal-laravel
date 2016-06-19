<?php

namespace greedchikara\Onesignal;

use Illuminate\Support\ServiceProvider;

/**
 * This is the service provider
 *
 * @package Onesignal
 * @author Shanky
 */
class OnesignalServiceProvider extends ServiceProvider
{

    protected $defer = true;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->publishes([
            __DIR__.'/../config/onesignal.php' => config_path('onesignal.php'),
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('greedchikara\Onesignal\Onesignal', function($app) {

            return new Onesignal($app['config']['onesignal']);
        });
    }

     /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['onesignal'];
    }
}


