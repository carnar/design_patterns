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
				$this->persistence->persist([
					$comment->getPostId(),
					$comment->getAuthor(),
					$comment->getAuthorEmail(),
					$comment->getSubject(),
					$comment->getBody()
				]);

			}
		}
		else
		{		
			$this->persistence->persist([
				$commentData->getPostId(),
				$commentData->getAuthor(),
				$commentData->getAuthorEmail(),
				$commentData->getSubject(),
				$commentData->getBody()
			]);
		}
	}

}