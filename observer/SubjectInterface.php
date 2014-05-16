<?php 

interface SubjectInterface {
	
	public function registerObserver(ObserverInterface $observer);
	public function removeObserver(ObserverInterface $observer);
	public function notifyObservers();

}