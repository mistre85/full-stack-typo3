<?php
namespace Wind\Csn\Tests\Unit\Domain\Model;

/**
 * Test case.
 */
class PostTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Wind\Csn\Domain\Model\Post
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Wind\Csn\Domain\Model\Post();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getMessageReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getMessage()
        );

    }

    /**
     * @test
     */
    public function setMessageForStringSetsMessage()
    {
        $this->subject->setMessage('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'message',
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
}
