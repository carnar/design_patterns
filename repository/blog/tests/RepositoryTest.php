<?php 

require_once '../../../vendor/autoload.php';
require_once '../CommentRepository.php';
require_once '../CommentFactory.php';
// require_once '../InMemoryPersistence.php';

class RepositoryTest extends PHPUnit_Framework_TestCase {
	
	protected function tearDown()
	{
		\Mockery::close();
	}

	function testItCallsThePersistenceWhenAddingAComment()
	{
        $persistenceGateway = \Mockery::mock('PersistenceInterface');
        $commentRepository = new CommentRepository($persistenceGateway);
        
        $commentData = [1, 'x', 'x', 'x', 'x'];
        $comment = (new CommentFactory())->make($commentData);

        $persistenceGateway->shouldReceive('persist')
        					->once()->with($commentData);

        $commentRepository->add($comment);
	}

	function testAPersitedCommentCanBeRetrievedFromTheGateway()
	{
		$persistenceGateway = new InMemoryPersistence();
		$commentRepository = new CommentRepository($persistenceGateway);

		$commentData = [1, 'x', 'x', 'x', 'x'];
		$comment = (new CommentFactory())->make($commentData);

		$commentRepository->add($comment);

		$this->assertEquals($commentData, $persistenceGateway->retrieve(0));
	}

	public function testItCanAddMultipleCommentsAtOnce()
	{
        $persistenceGateway = \Mockery::mock('PersistenceInterface');
        $commentRepository = new CommentRepository($persistenceGateway);
        
        $commentData1 = [1, 'x', 'x', 'x', 'x'];
        $comment1 = (new CommentFactory())->make($commentData1);
        $commentData2 = [2, 'y', 'y', 'y', 'y'];
        $comment2 = (new CommentFactory())->make($commentData2);

        $persistenceGateway->shouldReceive('persist')
        					->once()->with($commentData1);
        $persistenceGateway->shouldReceive('persist')
        					->once()->with($commentData2);

        $commentRepository->add([$comment1, $comment2]);
		
	}

}