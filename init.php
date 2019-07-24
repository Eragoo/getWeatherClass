<?php
include "Weather.php";

$city = new Weather(49, 32);
$weather = $city->getWeather();

var_dump($weather);

print "kek";
lol';