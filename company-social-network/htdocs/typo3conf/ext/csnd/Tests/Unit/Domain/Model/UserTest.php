<?php
namespace Wind\Csnd\Tests\Unit\Domain\Model;

/**
 * Test case.
 */
class UserTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Wind\Csnd\Domain\Model\User
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Wind\Csnd\Domain\Model\User();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

<<<<<<< HEAD


=======
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
    /**
     * @test
     */
    public function getUsernameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getUsername()
        );

    }

    /**
     * @test
     */
    public function setUsernameForStringSetsUsername()
    {
        $this->subject->setUsername('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'username',
            $this->subject
        );

    }

    /**
     * @test
     */
<<<<<<< HEAD
=======
    public function getAvatarReturnsInitialValueForFileReference()
    {
        self::assertEquals(
            null,
            $this->subject->getAvatar()
        );

    }

    /**
     * @test
     */
    public function setAvatarForFileReferenceSetsAvatar()
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setAvatar($fileReferenceFixture);

        self::assertAttributeEquals(
            $fileReferenceFixture,
            'avatar',
            $this->subject
        );

    }

    /**
     * @test
     */
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
    public function getEmailReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getEmail()
        );

    }

    /**
     * @test
     */
    public function setEmailForStringSetsEmail()
    {
        $this->subject->setEmail('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'email',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getPasswordReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getPassword()
        );

    }

    /**
     * @test
     */
    public function setPasswordForStringSetsPassword()
    {
        $this->subject->setPassword('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'password',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getNomeReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getNome()
        );

    }

    /**
     * @test
     */
    public function setNomeForStringSetsNome()
    {
        $this->subject->setNome('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'nome',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getCognomeReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getCognome()
        );

    }

    /**
     * @test
     */
    public function setCognomeForStringSetsCognome()
    {
        $this->subject->setCognome('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'cognome',
            $this->subject
        );

    }

    /**
     * @test
     */
<<<<<<< HEAD
=======
    public function getOnlineReturnsInitialValueForBool()
    {
        self::assertSame(
            false,
            $this->subject->getOnline()
        );

    }

    /**
     * @test
     */
    public function setOnlineForBoolSetsOnline()
    {
        $this->subject->setOnline(true);

        self::assertAttributeEquals(
            true,
            'online',
            $this->subject
        );

    }

    /**
     * @test
     */
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
    public function getPostListReturnsInitialValueForPost()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getPostList()
        );

    }

    /**
     * @test
     */
    public function setPostListForObjectStorageContainingPostSetsPostList()
    {
        $postList = new \Wind\Csnd\Domain\Model\Post();
        $objectStorageHoldingExactlyOnePostList = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOnePostList->attach($postList);
        $this->subject->setPostList($objectStorageHoldingExactlyOnePostList);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOnePostList,
            'postList',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function addPostListToObjectStorageHoldingPostList()
    {
        $postList = new \Wind\Csnd\Domain\Model\Post();
        $postListObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $postListObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($postList));
        $this->inject($this->subject, 'postList', $postListObjectStorageMock);

        $this->subject->addPostList($postList);
    }

    /**
     * @test
     */
    public function removePostListFromObjectStorageHoldingPostList()
    {
        $postList = new \Wind\Csnd\Domain\Model\Post();
        $postListObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $postListObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($postList));
        $this->inject($this->subject, 'postList', $postListObjectStorageMock);

        $this->subject->removePostList($postList);

    }
}
