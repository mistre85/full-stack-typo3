<?php

namespace Wind\Csnd\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use Wind\Csnd\Utility\CompanySocialNetwork;


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