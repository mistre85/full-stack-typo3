<?php
namespace Wind\Csnd\Domain\Model;

/***
 *
 * This file is part of the "Company Social Network Data" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
<<<<<<< HEAD
 *  (c) 2021 
=======
 *  (c) 2021
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
 *
 ***/

/**
 * User
 */
class User extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * username
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @var string
     * @validate NotEmpty
     */
    protected $username = '';

    /**
     * email
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @var string
     * @validate NotEmpty
     */
    protected $email = '';

    /**
     * password
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @var string
     * @validate NotEmpty
     */
    protected $password = '';

    /**
     * nome
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @var string
     * @validate NotEmpty
     */
    protected $nome = '';

    /**
     * cognome
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @var string
     * @validate NotEmpty
     */
    protected $cognome = '';

    /**
     * postList
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Wind\Csnd\Domain\Model\Post>
     * @cascade remove
     */
    protected $postList = null;

    /**
<<<<<<< HEAD
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
        $this->postList = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the username
     * 
=======
     * avatar
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @validate NotEmpty
     * @cascade remove
     */
    protected $avatar = null;

    /**
     * online
     *
     * @var bool
     * @validate NotEmpty
     */
    protected $online = false;

    /**
     * Returns the username
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @return string $username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Sets the username
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @param string $username
     * @return void
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Returns the email
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the email
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @param string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Returns the password
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @return string $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the password
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @param string $password
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Returns the nome
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @return string $nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Sets the nome
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @param string $nome
     * @return void
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * Returns the cognome
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @return string $cognome
     */
    public function getCognome()
    {
        return $this->cognome;
    }

    /**
     * Sets the cognome
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @param string $cognome
     * @return void
     */
    public function setCognome($cognome)
    {
        $this->cognome = $cognome;
    }

    /**
<<<<<<< HEAD
     * Adds a Post
     * 
=======
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
        $this->postList = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a Post
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @param \Wind\Csnd\Domain\Model\Post $postList
     * @return void
     */
    public function addPostList(\Wind\Csnd\Domain\Model\Post $postList)
    {
        $this->postList->attach($postList);
    }

    /**
     * Removes a Post
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @param \Wind\Csnd\Domain\Model\Post $postListToRemove The Post to be removed
     * @return void
     */
    public function removePostList(\Wind\Csnd\Domain\Model\Post $postListToRemove)
    {
        $this->postList->detach($postListToRemove);
    }

    /**
     * Returns the postList
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Wind\Csnd\Domain\Model\Post> $postList
     */
    public function getPostList()
    {
        return $this->postList;
    }

    /**
     * Sets the postList
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Wind\Csnd\Domain\Model\Post> $postList
     * @return void
     */
    public function setPostList(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $postList)
    {
        $this->postList = $postList;
    }
<<<<<<< HEAD
=======

    /**
     * Returns the avatar
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $avatar
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Sets the avatar
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $avatar
     * @return void
     */
    public function setAvatar(\TYPO3\CMS\Extbase\Domain\Model\FileReference $avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * Returns the online
     *
     * @return bool $online
     */
    public function getOnline()
    {
        return $this->online;
    }

    /**
     * Sets the online
     *
     * @param bool $online
     * @return void
     */
    public function setOnline($online)
    {
        $this->online = $online;
    }

    /**
     * Returns the boolean state of online
     *
     * @return bool
     */
    public function isOnline()
    {
        return $this->online;
    }
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
}
