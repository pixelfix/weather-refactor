<?php

namespace App\Classes;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class Weather
{
    private $apiKey;
    private $apiForecastUrl;

    public function __construct()
    {
        $this->apiKey = config('services.weather.key');
        $this->apiForecastUrl = 'https://api.weatherapi.com/v1/forecast.json';
    }

    public function getForecast($city,$days=3)
    {
        try
        {
            $apiResult = Http::get($this->apiForecastUrl,[
                'key' => $this->apiKey,
                'q' => $city,
                'days' => $days,
            ]);

            if(!isset($apiResult["error"]))
            {
                $weatherForecastArray = collect($apiResult["forecast"]["forecastday"]);
                $weatherForecast = $weatherForecastArray->map(function($value){
                    return [
                        'date' => $value["date"],
                        'condition' => $value["day"]["condition"]["text"],
                        'image' => "https://".ltrim($value["day"]["condition"]["icon"],"//"),
                    ];
                });

                return $weatherForecast;
            }
            return null;
        }
        catch(ConnectionException $e)
        {
            return null;
        }
    }
}
