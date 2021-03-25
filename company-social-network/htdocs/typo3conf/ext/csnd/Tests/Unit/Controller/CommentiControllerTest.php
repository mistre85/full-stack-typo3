<?php
namespace Windtre\Csnd\Tests\Unit\Controller;

/**
 * Test case.
 */
class CommentiControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Windtre\Csnd\Controller\CommentiController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Windtre\Csnd\Controller\CommentiController::class)
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
    public function listActionFetchesAllCommentisFromRepositoryAndAssignsThemToView()
    {

        $allCommentis = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $commentiRepository = $this->getMockBuilder(\Windtre\Csnd\Domain\Repository\CommentiRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $commentiRepository->expects(self::once())->method('findAll')->will(self::returnValue($allCommentis));
        $this->inject($this->subject, 'commentiRepository', $commentiRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('commentis', $allCommentis);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenCommentiToView()
    {
        $commenti = new \Windtre\Csnd\Domain\Model\Commenti();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('commenti', $commenti);

        $this->subject->showAction($commenti);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenCommentiToCommentiRepository()
    {
        $commenti = new \Windtre\Csnd\Domain\Model\Commenti();

        $commentiRepository = $this->getMockBuilder(\Windtre\Csnd\Domain\Repository\CommentiRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $commentiRepository->expects(self::once())->method('add')->with($commenti);
        $this->inject($this->subject, 'commentiRepository', $commentiRepository);

        $this->subject->createAction($commenti);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenCommentiToView()
    {
        $commenti = new \Windtre\Csnd\Domain\Model\Commenti();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('commenti', $commenti);

        $this->subject->editAction($commenti);
    }


    /**
     * @test
     */
    public function updateActionUpdatesTheGivenCommentiInCommentiRepository()
    {
        $commenti = new \Windtre\Csnd\Domain\Model\Commenti();

        $commentiRepository = $this->getMockBuilder(\Windtre\Csnd\Domain\Repository\CommentiRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $commentiRepository->expects(self::once())->method('update')->with($commenti);
        $this->inject($this->subject, 'commentiRepository', $commentiRepository);

        $this->subject->updateAction($commenti);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenCommentiFromCommentiRepository()
    {
        $commenti = new \Windtre\Csnd\Domain\Model\Commenti();

        $commentiRepository = $this->getMockBuilder(\Windtre\Csnd\Domain\Repository\CommentiRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $commentiRepository->expects(self::once())->method('remove')->with($commenti);
        $this->inject($this->subject, 'commentiRepository', $commentiRepository);

        $this->subject->deleteAction($commenti);
    }
}
