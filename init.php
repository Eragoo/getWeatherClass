<?php
include "WeatherClass.php";

$city = new Weather(49,35);
$weather = $city->getWeather();

var_dump($weather);
