<?php

namespace App\Http\Controllers;

use App\Http\API\NeutrinoApiClient;
use App\Http\API\OpenWeatherMapClient;
use App\Http\Requests\WeatherRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Arr;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('home', ['weather' => null]);
    }

    /**
     * @param WeatherRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function postGetWeather(WeatherRequest $request)
    {
        try {
            $address = app(NeutrinoApiClient::class)->geoCodeAddress($request->getAddress());
            $weather = app(OpenWeatherMapClient::class)->getWeatherByAddress([
                Arr::get($address, 'locations.0.city'),
                Arr::get($address,'locations.0.country-code'),
            ]);

            return view('home', ['weather' => $weather]);
        } catch (\Exception $exception) {
            dd($exception);
            return redirect()->back()->withErrors(['address' => 'please enter a valid address']);
        }
    }
}
