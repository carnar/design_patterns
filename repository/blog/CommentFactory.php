<?php 

require_once 'FactoryInterface.php';
require_once 'Comment.php';

/**
* 
*/
class CommentFactory implements FactoryInterface
{
	
	public function make($data)
	{
		return new Comment($data[0], $data[1], $data[2], $data[3], $data[4]);
	}
}