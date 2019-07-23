<?php 


class Weather{
    private $lat;
    private $lon;
    private $url = "api.openweathermap.org/data/2.5/weather?";
    private $api_key = "6a64e91caaef7e9663dc23664065acb4";

    public function __construct($lat, $lon){
        $this->lat = $lat;
        $this->lon = $lon;
    }

    public function getWeather(){
//
    }

    private function build_url(){

        $url_data = [
            'lat' => $this->lat,
            'lon' => $this->lon,
            'appid' => $this->api_key
        ];

        $url = $this->url . http_build_query($url_data);
        return $url;
    }



}