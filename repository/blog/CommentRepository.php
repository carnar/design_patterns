<?php 
require_once 'InMemoryPersistence.php';

class CommentRepository {
	
	private $persistence;
	
	function __construct(PersistenceInterface $persistence = null)
	{
		$this->persistence = $persistence? : new InMemoryPersistence();
	}

	public function add($commentData)
	{
		if(is_array($commentData))
		{
			foreach ($commentData as $comment) {
				$this->addOne($comment);
			}
		}
		else
		{		
			$this->addOne($commentData);
		}
	}

	private function addOne(Comment $comment)
	{
		$this->persistence->persist([
			$comment->getPostId(),
			$comment->getAuthor(),
			$comment->getAuthorEmail(),
			$comment->getSubject(),
			$comment->getBody()
		]);
		
	}

	public function findAll()
	{
		$allCommentsData = $this->persistence->retrieveAll();
		$comments = [];

		foreach ($allCommentsData as $commentData) {
			$comments[] = $this->commentFactory->make($commentData);
		}
		
		return $comments;
	}
}