<?php
namespace Wind\Csnd\Command;


class CsndCommandController extends \TYPO3\CMS\Extbase\Mvc\Controller\CommandController
{

    public function simpleCommand()
    {
        echo "simpleCommand\n";
    }

    public  function clearCacheCommand()
    {
        $GLOBALS['BE_USER']->user['admin'] = 1;
        $tce = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\DataHandling\\DataHandler');
        $tce->start(array(), array());
        // Rosso
        $tce->clear_cacheCmd('system');
        // Giallo
        $tce->clear_cacheCmd('all');
        //Verde
        $tce->clear_cacheCmd('pages');
        return true;
    }

}