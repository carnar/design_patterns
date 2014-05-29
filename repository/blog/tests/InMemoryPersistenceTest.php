<?php 

require_once '../InMemoryPersistence.php';

class InMemoryPersistenceTest extends PHPUnit_Framework_TestCase {
	
	public function testItCanPersistAndRetriveASingleDataArray()
	{
		$data = array('data');

		$persistence = new InMemoryPersistence();
		$persistence->persist($data);

		$this->assertEquals($data, $persistence->retrieve(0));
	}

	public function testItCanPersistSeveralElementsAndRetrieveAnyOfThem()
	{
		$data1 = ['data1'];
		$data2 = ['data2'];

		$persistence = new InMemoryPersistence();
		$persistence->persist($data1);
		$persistence->persist($data2);

		$this->assertEquals($data1, $persistence->retrieve(0));
		$this->assertEquals($data2, $persistence->retrieve(1));

	}
}