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
 * The repository for Comments
 */
class CommentRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * Finds an object matching the given identifier.
     *
     * @param int $uid The identifier of the object to find
     * @return object The matching object if found, otherwise NULL
     * @api
     */
    public function findByUid($uid)
    {
        return $this->findByIdentifier($uid);
    }

}
