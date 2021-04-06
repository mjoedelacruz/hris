<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Solarium\Client;
use Solarium\Core\Client\Adapter\Curl;

class SolariumServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // create a cURL adapter instance
        $adapter = new Curl();
        $this->app->bind(Client::class, function ($app) {
           // dd($app['config']['solarium']);
            return new Client($adapter,$eventdispatcher,$app['config']['solarium']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function provides()
    {
        return [Client::class];
    }
}