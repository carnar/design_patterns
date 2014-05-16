<?php 

interface ObserverInterface
{
	public function update($temperature, $humidity, $messure);
}