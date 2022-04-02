<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Classes\Weather;

class WeatherController extends Controller
{

    public function getApiForecast(Request $request)
    {
        $weather = new Weather;
        $weatherResults = $weather->getForecast($request->input('city'),3);

        if($weatherResults === null)
        {
            return ["error","Please provide a valid city name!"];
        }

        return $weatherResults;
    }

    public function showWeatherIndex()
    {
        return view('index');
    }

    public function getWeatherForecast(Request $request)
    {
        $this->validate($request,[
            'city' => 'required | string'
        ]);

        $weather = new Weather;
        $weatherResults = $weather->getForecast($request->input('city'),3);

        return view('index',[
            'city' => $request->input('city'),
            'weatherResults' => $weatherResults,
        ]);
    }

}
