<?php
namespace Soso\WeatherTesting\lib;


class Temperature
{
    private $windSpeed;
    private $temp;
    private $unit = "imperial";
    private $city = "Toronto";
    private $endpoint = "api.openweathermap.org/data/2.5/weather";

    function __construct($city) {
        if (!empty($city) && is_string($city) && strlen($city)<100)
            $this->city = $city;
    }
    // function return false when any error occured
    function makeRequest() {
        $endpoint = $this->endpoint
                    ."?units=". $this->unit
                    ."&q=".$this->city
                    ."&appid=".$_ENV['WEATHER_API_KEY'];
        $client   = new \GuzzleHttp\Client();
        try {
            $response = $client->request('GET', $endpoint);
            if ($response->getStatusCode() == 200) {
                $apiJsonResponse = json_decode($response->getBody());
              //  echo '<pre>'; print_r($apiJsonResponse);
                if ($apiJsonResponse->wind && $apiJsonResponse->wind->speed) {
                    $this->windSpeed = $apiJsonResponse->wind->speed;
                }
                if ($apiJsonResponse->main && $apiJsonResponse->main->temp) {
                    $this->temp = $apiJsonResponse->main->temp;
                }
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
    }
    public function getCity() {
          return  $this->city;
    }
    public function getUnit() {
        if ($this->unit == 'metric')
            return 'c';
       return 'f';
    }
    public function calculateWindChillFactor() {
        return 35.74 + (0.6215 * $this->temp) + (0.4275 * $this->temp - 35.75)  *  $this->windSpeed ^ 0.16;
    }

}