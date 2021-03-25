<?php
namespace Windtre\Csnd\Tests\Unit\Domain\Model;

/**
 * Test case.
 */
class PostTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Windtre\Csnd\Domain\Model\Post
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Windtre\Csnd\Domain\Model\Post();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }



    /**
     * @test
     */
    public function getTextReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getText()
        );

    }

    /**
     * @test
     */
    public function setTextForStringSetsText()
    {
        $this->subject->setText('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'text',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getUserReturnsInitialValueForUser()
    {
        self::assertEquals(
            null,
            $this->subject->getUser()
        );

    }

    /**
     * @test
     */
    public function setUserForUserSetsUser()
    {
        $userFixture = new \Windtre\Csnd\Domain\Model\User();
        $this->subject->setUser($userFixture);

        self::assertAttributeEquals(
            $userFixture,
            'user',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getLikesReturnsInitialValueForUser()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getLikes()
        );

    }

    /**
     * @test
     */
    public function setLikesForObjectStorageContainingUserSetsLikes()
    {
        $like = new \Windtre\Csnd\Domain\Model\User();
        $objectStorageHoldingExactlyOneLikes = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneLikes->attach($like);
        $this->subject->setLikes($objectStorageHoldingExactlyOneLikes);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneLikes,
            'likes',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function addLikeToObjectStorageHoldingLikes()
    {
        $like = new \Windtre\Csnd\Domain\Model\User();
        $likesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $likesObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($like));
        $this->inject($this->subject, 'likes', $likesObjectStorageMock);

        $this->subject->addLike($like);
    }

    /**
     * @test
     */
    public function removeLikeFromObjectStorageHoldingLikes()
    {
        $like = new \Windtre\Csnd\Domain\Model\User();
        $likesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $likesObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($like));
        $this->inject($this->subject, 'likes', $likesObjectStorageMock);

        $this->subject->removeLike($like);

    }

    /**
     * @test
     */
    public function getCommentiReturnsInitialValueForCommenti()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getCommenti()
        );

    }

    /**
     * @test
     */
    public function setCommentiForObjectStorageContainingCommentiSetsCommenti()
    {
        $commenti = new \Windtre\Csnd\Domain\Model\Commenti();
        $objectStorageHoldingExactlyOneCommenti = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneCommenti->attach($commenti);
        $this->subject->setCommenti($objectStorageHoldingExactlyOneCommenti);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneCommenti,
            'commenti',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function addCommentiToObjectStorageHoldingCommenti()
    {
        $commenti = new \Windtre\Csnd\Domain\Model\Commenti();
        $commentiObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $commentiObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($commenti));
        $this->inject($this->subject, 'commenti', $commentiObjectStorageMock);

        $this->subject->addCommenti($commenti);
    }

    /**
     * @test
     */
    public function removeCommentiFromObjectStorageHoldingCommenti()
    {
        $commenti = new \Windtre\Csnd\Domain\Model\Commenti();
        $commentiObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $commentiObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($commenti));
        $this->inject($this->subject, 'commenti', $commentiObjectStorageMock);

        $this->subject->removeCommenti($commenti);

    }
}
