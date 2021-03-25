<?php
namespace Windtre\Csnd\Tests\Unit\Controller;

/**
 * Test case.
 */
class PostControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Windtre\Csnd\Controller\PostController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Windtre\Csnd\Controller\PostController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }



    /**
     * @test
     */
    public function listActionFetchesAllPostsFromRepositoryAndAssignsThemToView()
    {

        $allPosts = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $postRepository = $this->getMockBuilder(\Windtre\Csnd\Domain\Repository\PostRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $postRepository->expects(self::once())->method('findAll')->will(self::returnValue($allPosts));
        $this->inject($this->subject, 'postRepository', $postRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('posts', $allPosts);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenPostToView()
    {
        $post = new \Windtre\Csnd\Domain\Model\Post();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('post', $post);

        $this->subject->showAction($post);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenPostToPostRepository()
    {
        $post = new \Windtre\Csnd\Domain\Model\Post();

        $postRepository = $this->getMockBuilder(\Windtre\Csnd\Domain\Repository\PostRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $postRepository->expects(self::once())->method('add')->with($post);
        $this->inject($this->subject, 'postRepository', $postRepository);

        $this->subject->createAction($post);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenPostToView()
    {
        $post = new \Windtre\Csnd\Domain\Model\Post();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('post', $post);

        $this->subject->editAction($post);
    }


    /**
     * @test
     */
    public function updateActionUpdatesTheGivenPostInPostRepository()
    {
        $post = new \Windtre\Csnd\Domain\Model\Post();

        $postRepository = $this->getMockBuilder(\Windtre\Csnd\Domain\Repository\PostRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $postRepository->expects(self::once())->method('update')->with($post);
        $this->inject($this->subject, 'postRepository', $postRepository);

        $this->subject->updateAction($post);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenPostFromPostRepository()
    {
        $post = new \Windtre\Csnd\Domain\Model\Post();

        $postRepository = $this->getMockBuilder(\Windtre\Csnd\Domain\Repository\PostRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $postRepository->expects(self::once())->method('remove')->with($post);
        $this->inject($this->subject, 'postRepository', $postRepository);

        $this->subject->deleteAction($post);
    }
}
