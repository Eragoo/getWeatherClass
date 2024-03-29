<?php

require "WeatherClass.php";


class WeatherTest extends \PHPUnit\Framework\TestCase {
    private $weather;
 
    protected function setUp () {
        $lat = mt_rand(46, 56);
        $lon = mt_rand(10, 30);
        $this->weather = new Weather($lat, $lon);
    }

    protected function tearDown () {
        $this->weather = NULL;
    }

    public function testGetWeatherSuccess () {
        $result = $this->weather->getWeather();
        $this->assertEquals(true, is_array($result));
    }

    public function testGetWeatherException () {
        $result = $this->weather->getWeather();
        $this->assertEquals(true, method_exists($result, 'getMessage'));
    }
}