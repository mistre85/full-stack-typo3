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
}
