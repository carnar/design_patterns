<?php 

interface PersistenceInterface {
	public function persist($data);
	public function retrieve($id);
}