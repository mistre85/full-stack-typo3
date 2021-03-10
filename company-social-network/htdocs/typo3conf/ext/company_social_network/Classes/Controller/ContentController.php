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

use FluidTYPO3\Fluidcontent\Controller\ContentController as AbstractController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use Windtre\Csnd\Domain\Model\User;

/**
 * Content Controller
 *
 * @route off
 */
class ContentController extends AbstractController
{

    /**
     * postRepository
     *
     * @var \Windtre\Csnd\Domain\Repository\PostRepository
     * @inject
     */
    protected $postRepository = null;

    public function userProfileAction()
    {
        $json = file_get_contents("http://csn.local/fileadmin/assets/profile.json");
        $user = json_decode($json);
        $this->view->assign("user", $user);

        $data = $this->getData();

        $title = strtoupper($data['title']);

        $prezzo = str_replace(",", ".", $data['price']);
        $this->view->assign("prezzo", $prezzo);

        $this->view->assign("title", $title);
        $this->view->assign("emptyBlockData", "Blocco da costruire");
    }

    public function postBachecaAction()
    {
        $posts = $this->postRepository->findAll();
        $this->view->assign('posts', $posts);
    }

    public function connectedUsersAction()
    {
        $data = [
            ['name' => 'Anna Rossi', 'photo' => 'https://picsum.photos/100', 'connected' => rand(0,1)],
            ['name' => 'Paola Bianchi', 'photo' => 'https://picsum.photos/100', 'connected' => rand(0,1)],
            ['name' => 'Lucio Lupo', 'photo' => 'https://picsum.photos/100', 'connected' => rand(0,1)],
            ['name' => 'Maura Mancini', 'photo' => 'https://picsum.photos/100', 'connected' => rand(0,1)],
        ];
        $this->view->assign('conn_users', $data);
    }

    public function registrationFormAction()
    {
        $username = GeneralUtility::_GP('username');
        $email = GeneralUtility::_GP('email');
        $name = GeneralUtility::_GP('name');

        DebuggerUtility::var_dump([$username, $email, $name]);
    }
}