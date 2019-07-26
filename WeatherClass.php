<?php 


class Weather{

    private $lat;
    private $lon;
    private $url = "api.openweathermap.org/data/2.5/weather?";
    private $api_key = api_key;

    private $response;
    private $readyUrl;

    private $weather_params = [];

    public function __construct($lat=null, $lon=null) {
        $this->lat = $lat;
        $this->lon = $lon;
    }

    public function getWeather() {
        if(is_null($this->lat) && is_null($this->lon)){
            //exception
        }else{
            $this->build_url();
            $this->sendRequest();
            $this->processData();
            $this->dataLocalize();
            return $this->weather_params;
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
        $c = curl_init($this->readyUrl);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($c);
        $info = curl_getinfo($c);
        if($response == false){
            //exception
        }elseif($info['http_code'] >= 400 ){
            //exception
        }else{
            $this->response = $response;
        }
        
    }

    private function processData() {
        $format_resp = json_decode($this->response);
        $temp = $format_resp->main->temp;
        $pressure = $format_resp->main->pressure;
        $wind_speed = $format_resp->wind->speed;
        $weather_status = $format_resp->weather[0]->main;

        $this->weather_params = ['temp' => $temp,
                                 'pressure' => $pressure,
                                 'wind_speed' => $wind_speed,
                                 'weather_status' => $weather_status,
                                 'response' => $format_resp ];
    }

    private function dataLocalize() {
        define("TEMP_K", "273.15");
        define("SPEED_COEFF", "3.6");
        
        $this->weather_params['temp'] = round($this->weather_params['temp'] - TEMP_K);
        $this->weather_params['pressure'] = round($this->weather_params['pressure']);
        $this->weather_params['wind_speed'] = round($this->weather_params['wind_speed'] * SPEED_COEFF);
    }


}