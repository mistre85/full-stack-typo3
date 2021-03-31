<?php

namespace Wind\Csnd\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use Wind\Csnd\Domain\Model\User;

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
 * The repository for Posts
 */
class PostRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    protected $defaultOrderings = array(
        'crdate' => QueryInterface::ORDER_DESCENDING,
    );

    /**
     * @param User $user
     */
    public function findMyLastPost(User $user)
    {
        $query = $this->createQuery();
        $query->matching($query->equals('user.uid', $user->getUid()));
        $posts = $query->execute();
        //ultimo per data descending
        return $posts->getFirst();
    }

    /**
     * @param User $user
     */
    public function findAllOrderedComment()
    {
        $query = $this->createQuery();

        $query->setOrderings([
            'comments.crdate' => QueryInterface::ORDER_DESCENDING
        ]);

        return $query->execute();
    }
}
