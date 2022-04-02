<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Classes\Weather;
use App\Http\Requests\WeatherRequest;

class WeatherController extends Controller
{
    public function __invoke(WeatherRequest $request, Weather $weather)
    {
        $weatherResults = $weather->getForecast($request->input('city'),3);

        return view('index',[
            'city' => $request->input('city'),
            'weatherResults' => $weatherResults,
        ]);
    }

}
