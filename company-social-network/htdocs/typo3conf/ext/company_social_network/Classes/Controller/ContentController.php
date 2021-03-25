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
use Wind\Csnd\Domain\Model\Post;
use Wind\Csnd\Domain\Model\User;
use Wind\Csnd\Utility\CompanySocialNetwork;

/**
 * Content Controller
 *
 * @route off
 */
class ContentController extends AbstractController
{
    /**
     * userRepository
     *
     * @var \Wind\Csnd\Domain\Repository\UserRepository
     * @inject
     */
    protected $userRepository = null;


    /**
     * CompanySocialNetwork
     *
     * @var \Wind\Csnd\Utility\CompanySocialNetwork
     * @inject
     */
    protected $csn = null;


    /**
     * postRepository
     *
     * @var \Wind\Csnd\Domain\Repository\PostRepository
     * @inject
     */
    protected $postRepository = null;



    /**
     * ogni action nel controller viene eseguita
     * PRIMA del render del content element (componente)
     * possiamo quindi assegnare nuove variabili che verranno poi
     * presentate nel template MAIN del componente.
     *
     * per creare una action bisogna specificare:
     *  nomeFileComponente + Action
     */
    function herospaceAction()
    {
        $data = $this->getData();

        $title = strtoupper($data['title']);

        $prezzo = str_replace(",", ".", $data['price']);
        $this->view->assign("prezzo", $prezzo);

        $this->view->assign("title", $title);
        $this->view->assign("emptyBlockData", "Blocco da costruire");
    }


    function postListAction()
    {
        $user = $this->csn->getLoggedUser();

        if (!empty($user)) {
            $lastPost = $this->postRepository->findMyLastPost($user);
            $postList = $this->postRepository->findAll();

            //todo: da trasformare in viewhelper


            /** @var  $userFound */
            //$userFound = false;
            /** @var Post $post */
            //foreach ($postList as $post) {

                /** @var User $like */
            //    foreach ($post->getLikes() as $like) {
            //        if ($user->getUid() == $like->getUid()) {
            //            $userFound = true;
            //            break;
            //        }
            //    }

            //    if ($userFound) {
            //        $post->likeButtonLabel = "Non mi piace più";
            //        $userFound = false;
            //    } else {
            //        $post->likeButtonLabel = "Mi piace";
            //    }
            //}
            $this->view->assign("postList", $postList);

            $this->view->assign("lastPost", $lastPost);
        }
    }

    function chatWidgetAction()
    {
        $userId = CompanySocialNetwork::readUserCookie();
        $userList = $this->userRepository->findAllOther($userId);
        //$user = $this->csn->getLoggedUser();
        //$userList = $this->userRepository->findAllExcept($user);
        $this->view->assign("userList", $userList);
    }


    public function toggleUserStatusAction()
    {
        $user = $this->csn->getLoggedUser();
        $this->view->assign('user', $user);
    }


    function loginFormAction()
    {

    }

}
