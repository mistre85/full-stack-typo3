<?php
namespace Wind\Csnd\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class IfUserLoggedViewHelper extends AbstractViewHelper
{

    public function render()
    {
        // return "<h1>Prova</h1>";
        $userCookie = $_COOKIE['user'];

        if (!empty($userCookie)){
            return "Connesso";
        }
        else{
            return "Disconnesso";
        }
    }

}