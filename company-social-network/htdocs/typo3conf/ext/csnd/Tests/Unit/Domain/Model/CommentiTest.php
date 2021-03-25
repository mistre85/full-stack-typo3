<?php
namespace Windtre\Csnd\Tests\Unit\Domain\Model;

/**
 * Test case.
 */
class CommentiTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Windtre\Csnd\Domain\Model\Commenti
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Windtre\Csnd\Domain\Model\Commenti();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }



    /**
     * @test
     */
    public function getCommentoReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getCommento()
        );

    }

    /**
     * @test
     */
    public function setCommentoForStringSetsCommento()
    {
        $this->subject->setCommento('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'commento',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getUserReturnsInitialValueForUser()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getUser()
        );

    }

    /**
     * @test
     */
    public function setUserForObjectStorageContainingUserSetsUser()
    {
        $user = new \Windtre\Csnd\Domain\Model\User();
        $objectStorageHoldingExactlyOneUser = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneUser->attach($user);
        $this->subject->setUser($objectStorageHoldingExactlyOneUser);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneUser,
            'user',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function addUserToObjectStorageHoldingUser()
    {
        $user = new \Windtre\Csnd\Domain\Model\User();
        $userObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $userObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($user));
        $this->inject($this->subject, 'user', $userObjectStorageMock);

        $this->subject->addUser($user);
    }

    /**
     * @test
     */
    public function removeUserFromObjectStorageHoldingUser()
    {
        $user = new \Windtre\Csnd\Domain\Model\User();
        $userObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $userObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($user));
        $this->inject($this->subject, 'user', $userObjectStorageMock);

        $this->subject->removeUser($user);

    }
}
