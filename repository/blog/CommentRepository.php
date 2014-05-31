<?php 

class CommentRepository {
	
	private $persistence;
	
	function __construct(PersistenceInterface $persistence = null)
	{
		$this->persistence = $persistence;
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

}