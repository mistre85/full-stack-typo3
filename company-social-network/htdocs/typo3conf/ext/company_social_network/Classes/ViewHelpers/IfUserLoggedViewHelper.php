<?php

namespace Wind\Csnd\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;


class IfUserLoggedViewHelper extends AbstractViewHelper
{
    /**
     * @var \Wind\Csnd\Utility\CompanySocialNetwork
     * @inject
     */
    protected $csn = null;

    /**
     * @param array $page
     * @return mixed|null
     */
    public function render($page)
    {
        $loggedPage = $page['csn_loggedpage'];

        $userLogged = $this->csn->isUserLogged();

        if ($loggedPage && !$userLogged) {
            return null;
        }

        return $this->renderChildren();

    }


}