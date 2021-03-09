<?php
namespace Wind\Csnd\Tests\Unit\Controller;

/**
 * Test case.
 */
class UserControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Wind\Csnd\Controller\UserController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Wind\Csnd\Controller\UserController::class)
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
    public function listActionFetchesAllUsersFromRepositoryAndAssignsThemToView()
    {

        $allUsers = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $userRepository = $this->getMockBuilder(\Wind\Csnd\Domain\Repository\UserRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $userRepository->expects(self::once())->method('findAll')->will(self::returnValue($allUsers));
        $this->inject($this->subject, 'userRepository', $userRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('users', $allUsers);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenUserToView()
    {
        $user = new \Wind\Csnd\Domain\Model\User();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('user', $user);

        $this->subject->showAction($user);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenUserToUserRepository()
    {
        $user = new \Wind\Csnd\Domain\Model\User();

        $userRepository = $this->getMockBuilder(\Wind\Csnd\Domain\Repository\UserRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $userRepository->expects(self::once())->method('add')->with($user);
        $this->inject($this->subject, 'userRepository', $userRepository);

        $this->subject->createAction($user);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenUserToView()
    {
        $user = new \Wind\Csnd\Domain\Model\User();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('user', $user);

        $this->subject->editAction($user);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenUserInUserRepository()
    {
        $user = new \Wind\Csnd\Domain\Model\User();

        $userRepository = $this->getMockBuilder(\Wind\Csnd\Domain\Repository\UserRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $userRepository->expects(self::once())->method('update')->with($user);
        $this->inject($this->subject, 'userRepository', $userRepository);

        $this->subject->updateAction($user);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenUserFromUserRepository()
    {
        $user = new \Wind\Csnd\Domain\Model\User();

        $userRepository = $this->getMockBuilder(\Wind\Csnd\Domain\Repository\UserRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $userRepository->expects(self::once())->method('remove')->with($user);
        $this->inject($this->subject, 'userRepository', $userRepository);

        $this->subject->deleteAction($user);
    }
}
