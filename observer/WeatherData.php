<?php 
require_once 'SubjectInterface.php';

/**
* Weather Manager
*/
class WeatherData implements SubjectInterface
{
	private $observers;
	private $temperature;
	private $humidity;
	private $pressure;

	public function __construct()
	{
		$this->observers = new SplObjectStorage();
	}

	public function registerObserver(ObserverInterface $observer)
	{
		$this->observers->attach($observer);
	}

	public function removeObserver(ObserverInterface $observer)
	{
		$this->observers->detach($observer);
	}

	public function notifyObservers()
	{
		foreach ($this->observers as $observer) {
			$observer->update($this->temperature, $this->humidity, $this->pressure);
		}
	}

	public function mesurementsChanged()
	{
		$this->notifyObservers();
	}

	public function setMeasurements($temperature, $humidity, $pressure)
	{
		$this->temperature = $temperature;
		$this->humidity = $humidity;
		$this->pressure = $pressure;
		$this->mesurementsChanged();
	}
}