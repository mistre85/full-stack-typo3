<?php

namespace Wind\CompanySocialNetwork\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 author@mail.it <>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use FluidTYPO3\Fluidpages\Controller\PageController as AbstractController;

/**
 * Page Controller
 *
 * @route off
 */
class PageController extends AbstractController
{

    function loggedAction()
    {

        //controlla DB o COOKIE
        $logged = false;

        if (!$logged) {
            //eseguire una redirect
        }

    }

    function userProfilePageAction()
    {
        //die();
        //todo: finire di impletare con dati veri
        $userData = array(
            'nome' => 'Paolo',
            'cognome' => 'Mistretta',
            'account' => array(
                'username' => 'mistre',
                'mail' => 'paolo@mistre.it'
            )
        );

        //$this->view->assign('username',$userData['username']);
        $this->view->assign('userData', $userData);
        //$this->view->assignMultiple($userData);
    }

    function robertoUserProfilePageAction()
    {
        //var_dump($_REQUEST);
        //die();
        //todo: finire di impletare con dati veri
        $userData = array(
            'nome' => 'Roberto',
            'cognome' => 'Brambilla',
            'account' => array(
                'username' => 'brambillar',
                'mail' => 'roberto.brambilla@windtre.it.it'
            )
        );

        //$this->view->assign('username',$userData['username']);
        $this->view->assign('userData', $userData);
        //$this->view->assignMultiple($userData);
    }

}
