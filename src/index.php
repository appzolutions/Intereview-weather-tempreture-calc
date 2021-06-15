<?php
// load project bootstrap
require './bootstrap.php';
use \Soso\WeatherTesting\lib\TemperatureOutput;

$city = $_GET['city'] ? $_GET['city'] :'Toronto';
$weatherTemp = new \Soso\WeatherTesting\lib\Temperature($city);
// initialize the template variables
$weather = [
    'temperature_status'=>'-',
    'temperature_degree'=>'-',
    'temperature_city'  =>'-',
    'temperature_unit'  =>'-',
];
if ($weatherTemp->makeRequest()) {
    $weather = [
        'temperature_status'=>TemperatureOutput::printStatus($weatherTemp->calculateWindChillFactor()),
        'temperature_degree'=>TemperatureOutput::formatUnit($weatherTemp->getUnit()),
        'temperature_city'  =>$weatherTemp->getCity(),
        'temperature_unit'  =>$weatherTemp->calculateWindChillFactor(),
    ];
}

view('dashboard',$weather);

