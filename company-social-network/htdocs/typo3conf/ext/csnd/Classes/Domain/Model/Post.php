<?php
namespace Windtre\Csnd\Domain\Model;

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
     * user
     * 
     * @var \Windtre\Csnd\Domain\Model\User
     */
    protected $user = null;

    /**
     * likes
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Windtre\Csnd\Domain\Model\User>
     */
    protected $likes = null;

    /**
     * commenti
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Windtre\Csnd\Domain\Model\Commenti>
     * @cascade remove
     */
    protected $commenti = null;

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
        $this->likes = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->commenti = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
     * Returns the user
     * 
     * @return \Windtre\Csnd\Domain\Model\User $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Sets the user
     * 
     * @param \Windtre\Csnd\Domain\Model\User $user
     * @return void
     */
    public function setUser(\Windtre\Csnd\Domain\Model\User $user)
    {
        $this->user = $user;
    }

    /**
     * Adds a User
     * 
     * @param \Windtre\Csnd\Domain\Model\User $like
     * @return void
     */
    public function addLike(\Windtre\Csnd\Domain\Model\User $like)
    {
        $this->likes->attach($like);
    }

    /**
     * Removes a User
     * 
     * @param \Windtre\Csnd\Domain\Model\User $likeToRemove The User to be removed
     * @return void
     */
    public function removeLike(\Windtre\Csnd\Domain\Model\User $likeToRemove)
    {
        $this->likes->detach($likeToRemove);
    }

    /**
     * Returns the likes
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Windtre\Csnd\Domain\Model\User> $likes
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * Sets the likes
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Windtre\Csnd\Domain\Model\User> $likes
     * @return void
     */
    public function setLikes(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $likes)
    {
        $this->likes = $likes;
    }

    /**
     * Adds a Commenti
     * 
     * @param \Windtre\Csnd\Domain\Model\Commenti $commenti
     * @return void
     */
    public function addCommenti(\Windtre\Csnd\Domain\Model\Commenti $commenti)
    {
        $this->commenti->attach($commenti);
    }

    /**
     * Removes a Commenti
     * 
     * @param \Windtre\Csnd\Domain\Model\Commenti $commentiToRemove The Commenti to be removed
     * @return void
     */
    public function removeCommenti(\Windtre\Csnd\Domain\Model\Commenti $commentiToRemove)
    {
        $this->commenti->detach($commentiToRemove);
    }

    /**
     * Returns the commenti
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Windtre\Csnd\Domain\Model\Commenti> $commenti
     */
    public function getCommenti()
    {
        return $this->commenti;
    }

    /**
     * Sets the commenti
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Windtre\Csnd\Domain\Model\Commenti> $commenti
     * @return void
     */
    public function setCommenti(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $commenti)
    {
        $this->commenti = $commenti;
    }
}
