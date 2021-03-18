<?php
namespace Wind\Csnd\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Generic\Qom\OrderingInterface;
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
     * @param int $userId
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findAllOther($userId)
    {
        $query = $this->createQuery();
        $query->matching($query->logicalNot($query->equals('uid', $userId)));
        return $query->execute();
    }

    /**
     * @param \Wind\Csnd\Domain\Model\User $user
     */
    public function findAllExcept(\Wind\Csnd\Domain\Model\User $user)
    {
        $query = $this->createQuery();
        $query->matching($query->logicalNot($query->equals('uid', $user->getUid())));
        return $query->execute();
    }
}
