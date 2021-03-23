<?php

namespace Wind\Csnd\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Object\ObjectManagerInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;


class IfUserLoggedViewHelper extends AbstractViewHelper
{



    /**
     * @param array $page
     * @return mixed|null
     */
    public function render($page)
    {
        //id di pagine di tipo logged - soluzione statica
        //$loggedPage = array(7, 8, 20); //spostato in typoscript
        //$isLoggedPage = in_array($page['uid'], $loggedPage);

        //soluzione con il campo in pages
        $loggedPage = $page['csn_loggedpage'];
        $isLoggedPage = $loggedPage;

        $isLoggedUser = !empty($_COOKIE['user']);

        if ($isLoggedPage && !$isLoggedUser) {
            return null;
        }

        return $this->renderChildren();
    }

}