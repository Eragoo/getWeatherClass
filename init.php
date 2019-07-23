<?php
include "Weather.php";

$city = new Weather(49, 32);
$city->getWeather();