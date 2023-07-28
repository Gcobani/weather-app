<?php

namespace App\Providers;

use App\Http\API\NeutrinoApiClient;
use App\Http\API\OpenWeatherMapClient;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //I will bind my api clients,  handle our dependency injection here, so we don't need to think about constructor variables when using it
        $this->app->bind(NeutrinoApiClient::class, function () {
            return new NeutrinoApiClient(
                $this->app->make(Client::class),
                config('app.neutrinoapi.userId'),
                config('app.neutrinoapi.apiKey'),
                config('app.neutrinoapi.url')
            );
        });

        $this->app->bind(OpenWeatherMapClient::class, function () {
            return new OpenWeatherMapClient(
                $this->app->make(Client::class),
                config('app.openweathermap.apiKey'),
                config('app.openweathermap.url'),
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
