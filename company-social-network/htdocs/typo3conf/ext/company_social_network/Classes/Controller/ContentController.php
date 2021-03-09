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
use Wind\Csnd\Domain\Model\User;

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
     * @var \Wind\Csnd\Domain\Repository\PostRepository
     * @inject
     */
    protected $postRepository = null;

    /**
     * userRepository
     *
     * @var \Wind\Csnd\Domain\Repository\UserRepository
     * @inject
     */
    protected $userRepository = null;


    /**
     * ogni action nel controller viene eseguita
     * PRIMA del render del content element (componente)
     * possiamo quindi assegnare nuove variabili che verranno poi
     * presentate nel template MAIN del componente.
     *
     * per creare una action bisogna specificare:
     *  nomeFileComponente + Action
     */
    function paoloHerospaceAction()
    {
        $data = $this->getData();

        $title = strtoupper($data['title']);

        $prezzo = str_replace(",", ".", $data['price']);
        $this->view->assign("prezzo", $prezzo);

        $this->view->assign("title", $title);
        $this->view->assign("emptyBlockData", "Blocco da costruire");
    }

    function beppeHerospaceAction()
    {
        $data = $this->getData();

        $title = strtoupper($data['title']);

        $this->view->assign("title", $title);
        $this->view->assign("emptyBlockData", "Blocco da costruire");
    }

    /*$data = array(
            'user' => array(
                'avatar' => 'https://picsum.photos/140/140',
                'nome' => 'paolo',
                'cognome' => 'mistretta',
            ),
            'postList' => [
                array('text' => 'buongiornissimo', 'like' => 10),
                array('text' => 'lavoro ', 'like' => 1),
                array('text' => 'sono stufo', 'like' => 1)
            ]

        );*/


    function paoloPostListAction()
    {
        //dati reali
        $postList = $this->postRepository->findAll();
        $this->view->assign("postList", $postList);


    }

    function paoloChatWidgetAction()
    {
        $userList = $this->userRepository->findAll();
        $this->view->assign("userList", $userList);
    }

    function contactListAction()
    {
        $data = [
            //nome, foto, stato
        ];
    }


    function robertoPostListAction()
    {
        /*$postList = array(
            array(
                'text' => 'post uno',
                'comment' => 'commento uno',
                'like' => 10,
                'user' => array(
                    'avatar' => 'https://picsum.photos/40/40',
                    'nome' => 'paolo',
                    'cognome' => 'mistretta'

            )),
            array(
                'text' => 'post due',
                'comment' => 'commento due',
                'like' => 15,
                'user' => array(
                    'avatar' => 'https://picsum.photos/40/40',
                    'nome' => 'fabio',
                    'cognome' => 'picciau'
                )
            ),
            array(
                'text' => 'post tre',
                'comment' => 'commento tre',
                'like' => 50,
                'user' => array(
                    'avatar' => 'https://picsum.photos/40/40',
                    'nome' => 'roberto',
                    'cognome' => 'brambilla'
                )
            ),
        );*/
        //var_dump($postList);
        //$this->view->assign("postList", $postList);
        $postList = $this->postRepository->findAll();
        //var_dump($postList->toArray());
        $this->view->assign("postList", $postList);

    }

    function robertoPostUserListAction()
    {
        /*$postUserList = array (
            array (
            'user' => array(
                'avatar' => 'https://picsum.photos/40/40',
                'nome' => 'paolo',
                'cognome' => 'mistretta',
                'stato' => true

            )),
            array (
            'user' => array(
                'avatar' => 'https://picsum.photos/40/40',
                'nome' => 'fabio',
                'cognome' => 'picciau',
                'stato' => false

            )),
            array (
            'user' => array(
                'avatar' => 'https://picsum.photos/40/40',
                'nome' => 'roberto',
                'cognome' => 'brambilla',
                'stato' => true
            )),
        );*/
//        var_dump($postUserList);

        //$this->view->assign("postUserList", $postUserList);
        //$postUserList = $this->userRepository->findAll();

        /*foreach ($userList as &$user){
            $user['status'] = $user['connected'] ? "connected" : "offline";
        }*/

        $userList = $this->userRepository->findAll();
        $this->view->assign("userList", $userList);


    }

}
