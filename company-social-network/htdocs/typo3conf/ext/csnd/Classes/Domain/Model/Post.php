<?php

namespace Wind\Csnd\Domain\Model;

/***
 *
 * This file is part of the "Company Social Network Data" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2021
 *
 ***/

/**
 * Post
 */
class Post extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * text
     *
     * @var string
     * @validate NotEmpty
     */
    protected $text = '';

    /**
     * likes
     *
     * @var int
     */
    protected $likes = 0;

    /**
     * user
     *
     * @var \Wind\Csnd\Domain\Model\User
     */
    protected $user = null;

    /**
     * comments
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Wind\Csnd\Domain\Model\Comment>
     * @cascade remove
     */
    protected $comments = null;

    /**
     * online
     *
     * @var int
     * @validate NotEmpty
     */
    protected $crdate = null;

    /**
     * @return int
     */
    public function getCrdate()
    {
        return $this->crdate;
    }

    /**
     * @param int $crdate
     */
    public function setCrdate($crdate)
    {
        $this->crdate = $crdate;
    }


    /**
     * Returns the text
     *
     * @return string $text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets the text
     *
     * @param string $text
     * @return void
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Returns the likes
     *
     * @return int $likes
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * Sets the likes
     *
     * @param int $likes
     * @return void
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;
    }

    /**
     * Returns the user
     *
     * @return \Wind\Csnd\Domain\Model\User $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Sets the user
     *
     * @param \Wind\Csnd\Domain\Model\User $user
     * @return void
     */
    public function setUser(\Wind\Csnd\Domain\Model\User $user)
    {
        $this->user = $user;
    }

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->comments = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a Comment
     *
     * @param \Wind\Csnd\Domain\Model\Comment $comment
     * @return void
     */
    public function addComment(\Wind\Csnd\Domain\Model\Comment $comment)
    {
        $this->comments->attach($comment);
    }

    /**
     * Removes a Comment
     *
     * @param \Wind\Csnd\Domain\Model\Comment $commentToRemove The Comment to be removed
     * @return void
     */
    public function removeComment(\Wind\Csnd\Domain\Model\Comment $commentToRemove)
    {
        $this->comments->detach($commentToRemove);
    }

    /**
     * Returns the comments
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Wind\Csnd\Domain\Model\Comment> $comments
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Sets the comments
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Wind\Csnd\Domain\Model\Comment> $comments
     * @return void
     */
    public function setComments(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $comments)
    {
        $this->comments = $comments;
    }
}
