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

<<<<<<< HEAD


=======
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
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
}
