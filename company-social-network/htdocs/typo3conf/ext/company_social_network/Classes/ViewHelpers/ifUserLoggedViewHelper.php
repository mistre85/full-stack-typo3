<?php
namespace Wind\Csnd\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class IfUserLoggedViewHelper extends AbstractViewHelper
{

    /** 
     * @param array $page
     * @return mixed|null
     */
    public function render($page)
    {
        // return "<h1>Prova</h1>";
        //id di pagine di tipo logged
  
        $loggedPage = array(6, 7, 8);
        $isLoggedPage = in_array($page['uid'], $loggedPage);
        $isLoggedUser = !empty($_COOKIE['user']);

        if($isLoggedPage && !$isLoggedUser){
            return null; 
        }

        return $this->renderChildren();
    }

}