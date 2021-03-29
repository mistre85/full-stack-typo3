<?php

namespace Wind\CompanySocialNetwork\View;

class PostCommentStandaloneView extends \TYPO3\CMS\Fluid\View\StandaloneView
{

    public function __construct()
    {
        parent::__construct();

        //da indagare altri format
        $this->setFormat('html');

        //trasforma in path assoluto
        $template = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
            'EXT:company_social_network/Resources/Private/View/PostComment.html'
        );

        //assegno alla vista
        $this->setTemplatePathAndFilename($template);

        //per caricare i partial
        $this->setPartialRootPaths(array('EXT:company_social_network/Resources/Private/Partials'));

        $extensionKey = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase("company_social_network");

        $this->getRequest()->setControllerExtensionName($extensionKey);
    }

}