<?php 

class CommentRepository {
	
	private $persistence;
	
	function __construct(PersistenceInterface $persistence = null)
	{
		$this->persistence = $persistence;
	}

	public function add(Comment $comment)
	{
		$this->persistence->persist([
			$comment->getPostId(),
			$comment->getAuthor(),
			$comment->getAuthorEmail(),
			$comment->getSubject(),
			$comment->getBody()
		]);
	}

}