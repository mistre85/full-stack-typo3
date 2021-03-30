<?php


namespace Wind\CompanySocialNetwork\View;


use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

class PostCommentStandaloneView extends \TYPO3\CMS\Fluid\View\StandaloneView
{

    public function __construct()
    {
        parent::__construct();

        $this->setFormat('html');
        $template = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
            'EXT:company_social_network/Resources/Private/View/PostComment.html'
        );

        /* Assegno alla vista */
        $this->setTemplatePathAndFilename($template);
        /* Serve per permettere il caricamento dei Partials */
        $this->setPartialRootPaths(array('EXT:company_social_network/Resources/Private/Partials'));

        $extensionKey = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase("company_social_network");
        $this->getRequest()->setControllerExtensionName($extensionKey);
    }


}