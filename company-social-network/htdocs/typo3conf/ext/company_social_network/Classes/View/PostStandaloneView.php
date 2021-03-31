<?php

namespace Wind\CompanySocialNetwork\View;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class PostStandaloneView extends \TYPO3\CMS\Fluid\View\StandaloneView{


    public function __construct()
    {
        parent::__construct();        
        
        // da indagare altri formati
        $this->setFormat('html');

        //$this->setPostCommentView();

        // trasforma in path assoluto
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

    public function setPostCommentView(){

         // trasforma in path assoluto
         $template = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
            'EXT:company_social_network/Resources/Private/Partials/UserListItem.html'
        );

        //assegno alla vista
        $this->setTemplatePathAndFilename($template);
    }

    public function setLikesTextView(){

        // trasforma in path assoluto
        $template = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
           'EXT:company_social_network/Resources/Private/Partials/LikeText.html'
       );

       //assegno alla vista
       $this->setTemplatePathAndFilename($template);
   }

    public function setLikeButtonView(){

        // trasforma in path assoluto
        $template = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
            'EXT:company_social_network/Resources/Private/Partials/LikeButton.html'
        );

        //assegno alla vista
        $this->setTemplatePathAndFilename($template);
    }


}
