<?php

namespace Wind\CompanySocialNetwork\View;

class PostStandaloneView extends \TYPO3\CMS\Fluid\View\StandaloneView
{

    public function __construct()
    {
        parent::__construct();

        //da indagare altri format
        $this->setFormat('html');

        //trasforma in path assoluto
        $template = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
            'EXT:company_social_network/Resources/Private/Partials/UserListItem.html'
        );

        //assegno alla vista
        $this->setTemplatePathAndFilename($template);

        //per caricare i partial
        //$this->setPartialRootPaths(array('EXT:company_social_network/Resources/Private/Partials'));

        $extensionKey = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase("company_social_network");

        $this->getRequest()->setControllerExtensionName($extensionKey);
    }

    public function setLikesTextView()
    {
        //trasforma in path assoluto
        $template = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
            'EXT:company_social_network/Resources/Private/Partials/LikesText.html'
        );

        //assegno alla vista
        $this->setTemplatePathAndFilename($template);
    }

    public function setLikeButtonView()
    {
        //trasforma in path assoluto
        $template = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
            'EXT:company_social_network/Resources/Private/Partials/LikeButton.html'
        );

        //assegno alla vista
        $this->setTemplatePathAndFilename($template);
    }


}