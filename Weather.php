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
        $this->dataLocalize();

    }

    public function getWeather() {
        return $this->weather_params;
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
        $c = curl_init($this->readyUrl);
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

    private function dataLocalize() {
        define("TEMP_K", "273.15");
        define("SPEED_COEFF", "3.6");
        
        $this->weather_params['temp'] = round($this->weather_params['temp'] - TEMP_K);
        $this->weather_params['pressure'] = round($this->weather_params['pressure']);
        $this->weather_params['wind_speed'] = round($this->weather_params['wind_speed'] * SPEED_COEFF);
    }


}