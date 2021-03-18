<?php
namespace Windtre\Csnd\Domain\Repository;

use Windtre\Csnd\Domain\Model\User;

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
 * The repository for Users
 */
class UserRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * @param User $user
     * @return array
     */
    public function findAllExceptUser(User $user)
    {
        $query = $this->createQuery();
        $query->matching($query->logicalNot($query->equals('uid', $user->getUid())));
        return $query->execute();
    }
}
