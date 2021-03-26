<?php

namespace  Wind\CompanySocialNetwork\View;


class UserStatusStandaloneView extends \TYPO3\CMS\Fluid\View\StandaloneView
{
    public function __construct()
    {
        parent::__construct();
        $this->setFormat('html');
        $template = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
            'EXT:company_social_network/Resources/Private/View/ToggleUserStatus.html'
        );
        // Assegnazione alla vista
        $this->setTemplatePathAndFilename($template);
        /*  */
        $extensionKey = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase("company_social_network");
        $this->getRequest()->setControllerExtensionName($extensionKey);
    }
}