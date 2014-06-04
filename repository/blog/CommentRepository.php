<?php 
require_once 'InMemoryPersistence.php';
require_once 'CommentFactory.php';

class CommentRepository {
	
	private $persistence;
	private $commentFactory;
	
	function __construct(PersistenceInterface $persistence = null)
	{
		$this->persistence = $persistence? : new InMemoryPersistence();
		$this->commentFactory = new CommentFactory();
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

	public function findByPostId($postId)
	{
		return array_values(
			array_filter($this->findAll(), function ($comment) use ($postId) {
        		return $comment->getPostId() == $postId;
   			})
		);
	}
}