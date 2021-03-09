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
 * Post
 */
class Post extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * text
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @var string
     * @validate NotEmpty
     */
    protected $text = '';

    /**
     * likes
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @var int
     */
    protected $likes = 0;

    /**
     * user
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @var \Wind\Csnd\Domain\Model\User
     */
    protected $user = null;

    /**
     * Returns the text
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @return string $text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets the text
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @param string $text
     * @return void
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Returns the likes
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @return int $likes
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * Sets the likes
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @param int $likes
     * @return void
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;
    }

    /**
     * Returns the user
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @return \Wind\Csnd\Domain\Model\User $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Sets the user
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @param \Wind\Csnd\Domain\Model\User $user
     * @return void
     */
    public function setUser(\Wind\Csnd\Domain\Model\User $user)
    {
        $this->user = $user;
    }
}
