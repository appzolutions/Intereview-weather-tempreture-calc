<?php
namespace Soso\WeatherTesting\lib;


class TemperatureOutput
{
     static $cold_weather_f = [
         'f'=> [
            'mild'   => 60,
            'cold'   => 50,
            'extreme'=> 32, // 0c
            'freeze' => 5
         ]
    ];
    //
    static function  printStatus($temp) {
        if ($temp>= TemperatureOutput::$cold_weather_f['f']['mild']) {
            return 'Hot';
        }
        if (in_array($temp, range(TemperatureOutput::$cold_weather_f['f']['mild'],TemperatureOutput::$cold_weather_f['f']['cold'])) ) {
            return 'Mild';
        }
        if (in_array($temp, range(TemperatureOutput::$cold_weather_f['f']['cold'],TemperatureOutput::$cold_weather_f['f']['extreme'])) ) {
            return 'Cold';
        }
        if (in_array($temp, range(TemperatureOutput::$cold_weather_f['f']['extreme'],TemperatureOutput::$cold_weather_f['f']['freeze'])) ) {
            return 'freeze';
        }
        return 'Unknown!';
    }
    static function  formatUnit($unit) {
            return strtoupper('°'.$unit);
    }
}