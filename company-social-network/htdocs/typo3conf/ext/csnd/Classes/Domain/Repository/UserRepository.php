<?php
namespace Wind\Csnd\Domain\Repository;

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
     * @param int $userid
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * 
     * @var \Wind\Csnd\Domain\Repository\UserRepository
     * @inject
     */
    public function findAllUserNotMe($userid)
    {
        $query = $this->createQuery();
        $query->matching($query->logicalNot($query->equals('uid', $userid)));
        //$query->matching($query->equals('uid', $userid));
        // non funziona // $query->matching($query->contains('uid', $userid));
        return $query->execute();
    }


}
