<?php
namespace Wind\Csn\Domain\Model;

/***
 *
 * This file is part of the "Company Social Network (extbase)" Extension for TYPO3 CMS.
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
     * message
     *
     * @var string
     * @validate NotEmpty
     */
    protected $message = '';

    /**
     * likes
     *
     * @var int
     */
    protected $likes = 0;

    /**
     * Returns the message
     *
     * @return string $message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Sets the message
     *
     * @param string $message
     * @return void
     */
    public function setMessage($message)
    {
        $this->message = $message;
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
}
