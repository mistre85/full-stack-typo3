<?php

namespace Wind\CompanySocialNetwork\View;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class UserStatusStandaloneView extends \TYPO3\CMS\Fluid\View\StandaloneView{


    public function __construct()
    {
        parent::__construct();        
        
        // da indagare altri formati
        $this->setFormat('html');

        // trasforma in path assoluto
        $template = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
            'EXT:company_social_network/Resources/Private/View/UserStatus.html'
        );

        //assegno alla vista
        $this->setTemplatePathAndFilename($template);

        $extensionKey = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase("company_social_network");
        $this->getRequest()->setControllerExtensionName($extensionKey);
    }
}

