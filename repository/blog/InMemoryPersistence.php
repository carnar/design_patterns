<?php 
require_once 'PersistenceInterface.php';

class InMemoryPersistence implements PersistenceInterface {
	
	private $data = [];

	public function persist($data)
	{
		$this->data[] = $data;
	}

	public function retrieve($id)
	{
		return $this->data[$id];
	}

	public function retrieveAll()
	{
		return $this->data;
	}

}