<?php 
require_once 'ObserverInterface.php';
require_once 'DisplayInterface.php';

/**
* Application using Weather Data 
*/
class CurrentConditionDisplay implements ObserverInterface, DisplayInterface
{
	private $temperature;
	private $humidity;
	private $pressure;
	private $weatherData;

	function __construct(WeatherData $weatherData)
	{
		$this->weatherData = $weatherData;
		$this->weatherData->registerObserver($this);
	}

	public function update($temperature, $humidity, $pressure)
	{
		$this->temperature = $temperature;
		$this->humidity = $humidity;
		$this->pressure = $pressure;
		$this->display();
	}

	public function display()
	{
		echo "<h1>CurrentConditionDisplay</h1>";
		echo '<p>Temperature:' . $this->temperature . '</p>';
		echo '<br />Humidity:' . $this->humidity . '</p>';
		echo '<br />Pressure:' . $this->pressure . '</p>';
	}
}