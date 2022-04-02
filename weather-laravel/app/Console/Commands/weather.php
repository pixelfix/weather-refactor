<?php

namespace App\Console\Commands;

use App\Classes\Weather as ClassesWeather;
use Illuminate\Console\Command;

class weather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather {--c|cities=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Weather command that takes cities as an input and provide forecast as output.';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    private ClassesWeather $weather;

    public function __construct(ClassesWeather $weather)
    {
        parent::__construct();
        $this->weather = $weather;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cities = explode(",",$this->option('cities'));

        $tableHeader[0] = "City";
        $tableHeader[1] = date('Y-m-d');
        $tableHeader[2] = date('Y-m-d',strtotime('+1day'));
        $tableHeader[3] = date('Y-m-d',strtotime('+2days'));

        if(is_array($cities))
        {
            $cities = collect($cities);
            $connectionError = false;

            $weatherResults = $cities->map(function($cityName) use (&$connectionError) {
                $cityResult = $this->weather->getForecast($cityName);
                if($cityResult !== null)
                {
                    $forecast = $cityResult->map(function($value){
                        return $value["condition"];
                    });
                    return $forecast->prepend($cityName)->toArray();
                }
                $connectionError = true;
                return [$cityName];

            });

            $this->table($tableHeader,$weatherResults->toArray());
            if($connectionError === true)
            {
                $this->error('Error detected: Please check your input and/or connection to the weather API.');
            }
        }
        else
        {
            $this->error('Error detected: Please enter at least 1 city as an argument.');
        }
    }
}
