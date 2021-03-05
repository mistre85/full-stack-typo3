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

/**
 * Content Controller
 *
 * @route off
 */
class ContentController extends AbstractController
{

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

    function beppeBachecaAction()
    {
        //utente ->(1,*) post
        //post_utente ->1 utente

        $postList = array(
            array('text' => 'buongiornissimo', 'like' => 10, 'user' => array(
                'avatar' => 'https://picsum.photos/140/140',
                'nome' => 'paolo',
                'cognome' => 'mistretta'
            )),
            array('text' => 'buongiornissimo', 'like' => 10, 'user' => array(
                'avatar' => 'https://picsum.photos/140/140',
                'nome' => 'fabio',
                'cognome' => 'picciau'
            )),
            array('text' => 'buongiornissimo', 'like' => 10, 'user' => array(
                'avatar' => 'https://picsum.photos/140/140',
                'nome' => 'roberto',
                'cognome' => 'brambilla'
            )),
        );

        $this->view->assign("postList", $postList);
    }

    function beppeContactListAction()
    {
        $data = [
            array(
                'avatar' => 'https://picsum.photos/140/140',
                'nome' => 'Paolo',
                'cognome' => 'mistretta',
                'stato' => 'attivo'
            ),
            array(
                'avatar' => 'https://picsum.photos/140/140',
                'nome' => 'Roberto',
                'cognome' => 'Brambilla',
                'stato' => 'disattivo'
            ),
            array(
                'avatar' => 'https://picsum.photos/140/140',
                'nome' => 'Giuseppe',
                'cognome' => 'Orlando',
                'stato' => 'attivo'
            )
        ];

        $this->view->assign("postList", $data);
    }


}
