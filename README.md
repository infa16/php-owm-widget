# CWeather

## Introduction
CWeather is a class for generating a weather-module that can be implemented on
whatever website you desire. It can be used with Anax-MVC but it is not dependent on it. 

## License
This software is free software and carries a MIT license.

## How to install
To install the package, add the row below to your composer.json file:

```
"require": {
"infa16/weather": "dev-master"
}
```

To add CWeather, the easiest way is to initialize it when/where you need it:

```
$weather = new \infa16\Weather\CWeather("<appid>", "<city>");
```


## How to use
You have to sign in and get a valid appid from http://openweathermap.org/
before you can use the service. When you have done that you also need to 
set the city you want to get the weather-report from.  

You can use the module with or without the css-file.
