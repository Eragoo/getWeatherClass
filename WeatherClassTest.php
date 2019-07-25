<?php

require "WeatherClass.php";

class WeatherTest extends PHPUnit_Framework_TestCase {
    private $weather;
    private $lat;
    private $lon;

    protected function generateParams () {
        $lat = mt_rand(46, 56);
        $lon = mt_rand(10, 30);
        $this->lat = $lat;
        $this->lon = $lon;
    }
 
    protected function setUp () {
        $this->weather = new Wether($this->lat, $this->lon);
    }
}