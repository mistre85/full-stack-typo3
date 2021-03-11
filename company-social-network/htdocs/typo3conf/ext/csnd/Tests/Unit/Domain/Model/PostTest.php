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
    public function getLikesReturnsInitialValueForInt()
    {
    }

    /**
     * @test
     */
    public function setLikesForIntSetsLikes()
    {
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
}
