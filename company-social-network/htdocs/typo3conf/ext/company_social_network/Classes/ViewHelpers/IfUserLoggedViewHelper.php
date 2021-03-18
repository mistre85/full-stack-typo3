<?php

namespace Windtre\CompanySocialNetwork\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class IfUserLoggedViewHelper extends AbstractViewHelper
{
    /**
     * @param array $page
     * @return mixed|null
     */
    public function render($page)
    {
        // id pagina di tipo logged
        $loggedPage = array(4, 7, 10, 11, 14);
        $isLoggedPage = in_array($page['uid'], $loggedPage);
        $isLoggedUser = !empty($_COOKIE['user']);

        if( !$isLoggedUser && $isLoggedPage ) {
            return null;
        }
        return $this->renderChildren();
    }

}