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
 * Comment
 */
class Comment extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
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
