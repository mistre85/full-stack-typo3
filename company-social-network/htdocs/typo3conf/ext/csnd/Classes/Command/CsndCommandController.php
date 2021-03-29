<?php

namespace Wind\Csnd\Command;


/**
 * https://docs.typo3.org/m/typo3/book-extbasefluid/8.7/en-us/10-Outlook/3-Command-controllers.html
 * Class CsndCommandController
 * @package Wind\Csnd\Command
 */
class CsndCommandController extends \TYPO3\CMS\Extbase\Mvc\Controller\CommandController
{

    public function clearCacheCommand()
    {
        $GLOBALS['BE_USER']->user['admin'] = 1;

        $tce = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\DataHandling\\DataHandler');

        $tce->start(array(), array());

        //rosso
        $tce->clear_cacheCmd('system');

        //giallo
        $tce->clear_cacheCmd('all');

        //verde
        $tce->clear_cacheCmd('pages');

        return true;
    }
}