<?php
namespace Wind\Csnd\Tests\Unit\Domain\Model;

/**
 * Test case.
 */
class PostTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Wind\Csnd\Domain\Model\Post
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Wind\Csnd\Domain\Model\Post();
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
        $userFixture = new \Wind\Csnd\Domain\Model\User();
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
    public function getCommentsReturnsInitialValueForComment()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getComments()
        );

    }

    /**
     * @test
     */
    public function setCommentsForObjectStorageContainingCommentSetsComments()
    {
        $comment = new \Wind\Csnd\Domain\Model\Comment();
        $objectStorageHoldingExactlyOneComments = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneComments->attach($comment);
        $this->subject->setComments($objectStorageHoldingExactlyOneComments);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneComments,
            'comments',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function addCommentToObjectStorageHoldingComments()
    {
        $comment = new \Wind\Csnd\Domain\Model\Comment();
        $commentsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $commentsObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($comment));
        $this->inject($this->subject, 'comments', $commentsObjectStorageMock);

        $this->subject->addComment($comment);
    }

    /**
     * @test
     */
    public function removeCommentFromObjectStorageHoldingComments()
    {
        $comment = new \Wind\Csnd\Domain\Model\Comment();
        $commentsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $commentsObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($comment));
        $this->inject($this->subject, 'comments', $commentsObjectStorageMock);

        $this->subject->removeComment($comment);

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
        $like = new \Wind\Csnd\Domain\Model\User();
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
        $like = new \Wind\Csnd\Domain\Model\User();
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
        $like = new \Wind\Csnd\Domain\Model\User();
        $likesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $likesObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($like));
        $this->inject($this->subject, 'likes', $likesObjectStorageMock);

        $this->subject->removeLike($like);

    }
}
