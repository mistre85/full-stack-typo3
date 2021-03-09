<?php
namespace Wind\Csnd\Domain\Repository;

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
 * The repository for Posts
 */
class PostRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
<<<<<<< HEAD


=======
    /**
     * Initializes the repository.
     *
     * @return void
     */
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
    public function initializeObject()
    {
        /** @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
        $querySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($querySettings);
    }
<<<<<<< HEAD
    

=======
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
}
