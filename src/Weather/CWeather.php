<?php

namespace infa16\Weather;

class CWeather
{
    private $appid;
    private $city;
    private $units = "metric";

    /**
     * CWeather constructor.
     * @param string $appid
     * @param string $city
     */
    public function __construct($appid, $city)
    {
        $this->appid = $appid;
        $this->city = $city;
    }

    /**
     * @param string $units 'metric' or 'imperial'
     */
    public function setUnits($units)
    {
        $this->units = $units;
    }

    /**
     * Renders the html
     */
    public function view()
    {
        $data = $this->getData();
        $html = '<div class="weather">';
        $html .= '<div class="weather-city">' . htmlentities($data["name"]) . '</div>';
        $html .= '<div class="weather-img"><img src="http://openweathermap.org/img/w/' . $data["weather"][0]["icon"] . '.png"/></div>';
        $html .= '<div class="weather-temp">' . round($data["main"]["temp"], 1) . ($this->units == "metric" ? " &deg;C" : " &deg;F") . '</div>';
        $html .= '<div class="weather-cloud">Weather: ' . htmlentities($data["weather"][0]["main"]) . '</div>';
        $html .= '<div class="weather-humidity">Humidity: ' . htmlentities($data["main"]["humidity"]) . ' %</div>';
        $html .= '<div class="weather-sunup">Sunrise: ' . gmdate("H:i", $data["sys"]["sunrise"]) . '</div>';
        $html .= '<div class="weather-sundown">Sunset: ' . gmdate("H:i", $data["sys"]["sunset"]) . '</div>';
        $html .= '</div>';
        return $html;
    }

    public function getUrl()
    {
        return "http://api.openweathermap.org/data/2.5/weather?q=" .
        $this->city . "&appid=" . $this->appid . "&units=" . $this->units;
    }


    protected function getData()
    {
        $response = file_get_contents($this->getUrl());
        return json_decode($response, true);
    }
}
