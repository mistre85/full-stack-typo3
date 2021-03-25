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
 * Commenti
 */
class Commenti extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * commento
     * 
     * @var string
     */
    protected $commento = '';

    /**
     * user
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Windtre\Csnd\Domain\Model\User>
     * @cascade remove
     */
    protected $user = null;

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
        $this->user = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the commento
     * 
     * @return string $commento
     */
    public function getCommento()
    {
        return $this->commento;
    }

    /**
     * Sets the commento
     * 
     * @param string $commento
     * @return void
     */
    public function setCommento($commento)
    {
        $this->commento = $commento;
    }

    /**
     * Adds a User
     * 
     * @param \Windtre\Csnd\Domain\Model\User $user
     * @return void
     */
    public function addUser(\Windtre\Csnd\Domain\Model\User $user)
    {
        $this->user->attach($user);
    }

    /**
     * Removes a User
     * 
     * @param \Windtre\Csnd\Domain\Model\User $userToRemove The User to be removed
     * @return void
     */
    public function removeUser(\Windtre\Csnd\Domain\Model\User $userToRemove)
    {
        $this->user->detach($userToRemove);
    }

    /**
     * Returns the user
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Windtre\Csnd\Domain\Model\User> $user
     */
    public function getUser()
    {
        return $this->user;
    }

//    /**
//     * Sets the user
//     *
//     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Windtre\Csnd\Domain\Model\User> $user
//     * @return void
//     */
//    public function setUser(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $user)
//    {
//        $this->user = $user;
//    }

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
}
