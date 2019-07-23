<?php 


class Weather{

    private $lat;
    private $lon;
    private $url = "api.openweathermap.org/data/2.5/weather?";
    private $api_key = "6a64e91caaef7e9663dc23664065acb4";

    private $responce;
    private $readyUrl;

    private $weather_params = [];

    public function __construct($lat, $lon) {
        $this->lat = $lat;
        $this->lon = $lon;

        $this->build_url();
        $this->sendRequest();
        $this->processData();

    }

    public function getWeather() {
        foreach($this->weather_params as $key->$value){
            print $key . " : " . $value . "\n"; 
        }
    }

    private function build_url() {

        $url_data = [
            'lat' => $this->lat,
            'lon' => $this->lon,
            'appid' => $this->api_key
        ];

        $url = $this->url . http_build_query($url_data);

        $this->readyUrl = $url;
    }

    private function sendRequest() {
        $c = curl_init($url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $responce = curl_exec($c);

        $this->responce = $responce;
        
    }

    private function processData() {
        $format_resp = json_decode($this->responce);
        $temp = $format_resp->main->temp;
        $pressure = $format_resp->main->pressure;
        $wind_speed = $format_resp->wind->speed;
        $weather_status = $format_resp->weather[0]->main;

        $this->weather_params = ['temp' => $temp,
                                 'pressure' => $pressure,
                                 'wind_speed' => $wind_speed,
                                 'weather_status' => $weather_status];
    }


}