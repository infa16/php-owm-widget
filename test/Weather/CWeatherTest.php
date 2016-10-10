<?php

namespace infa16\Weather;


class CWeatherTest extends \PHPUnit_Framework_TestCase
{
    public function testGetUrl()
    {
        $weather = new CWeather("123456789", "Uppsala");

        $url = $weather->getUrl();
        $this->assertEquals($url, "http://api.openweathermap.org/data/2.5/weather?q=Uppsala&appid=123456789&units=metric", "Url mismatch.");

        $weather->setUnits("imperial");
        $url = $weather->getUrl();
        $this->assertEquals($url, "http://api.openweathermap.org/data/2.5/weather?q=Uppsala&appid=123456789&units=imperial", "Url mismatch.");
    }

    public function testView()
    {
        $weather = $this->getMockBuilder('infa16\Weather\CWeather')
            ->setConstructorArgs(array("123456789", "Uppsala"))
            ->setMethods(array("getData"))
            ->getMock();

        $weather->expects($this->once())
            ->method('getData')
            ->will($this->returnValue(json_decode('
                   {"coord":{"lon":17.65,"lat":59.86},"weather":[{"id":803,"main":"Clouds","description":"broken clouds","icon":"04n"}],"base":"stations","main":{"temp":7.05,"pressure":1044.39,"humidity":83,"temp_min":7.05,"temp_max":7.05,"sea_level":1049.6,"grnd_level":1044.39},"wind":{"speed":2.67,"deg":51.0074},"clouds":{"all":76},"dt":1476125041,"sys":{"message":0.0065,"country":"SE","sunrise":1476076733,"sunset":1476114726},"id":2666199,"name":"Uppsala","cod":200}', true)));

        $html = $weather->view();
        $this->assertEquals($html, '<div class="weather"><div class="weather-city">Uppsala</div><div class="weather-img"><img src="http://openweathermap.org/img/w/04n.png"/></div><div class="weather-temp">7.1 &deg;C</div><div class="weather-cloud">Weather: Clouds</div><div class="weather-humidity">Humidity: 83 %</div><div class="weather-sunup">Sunrise: 05:18</div><div class="weather-sundown">Sunset: 15:52</div></div>');
    }
}
