<?php 
require_once 'WeatherData.php';
require_once 'CurrentConditionDisplay.php';

$weatherData = new WeatherData();
$currentConditionDisplay = new CurrentConditionDisplay($weatherData);

$weatherData->setMeasurements(30,10,5);
$weatherData->setMeasurements(20,15,15);