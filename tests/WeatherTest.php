<?php


class WeatherTest extends \PHPUnit\Framework\TestCase
{
    public function test_getting_city_temp() {
        $weatherTemp = new \Soso\WeatherTesting\lib\Temperature('Winnipeg');
        $this->assertTrue($weatherTemp->makeRequest());
    }
    public function test_if_unit_is_f() {
        $weatherTemp = new \Soso\WeatherTesting\lib\Temperature('Winnipeg');
        $this->assertEquals('f', $weatherTemp->getUnit());
    }
}