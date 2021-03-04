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

    function beppeBachecaAction()
    {
        $data = [
            array('user' => array('nome' => 'Giuseppe', 'cognome' => 'Orlando')),
            array('post' => array('text' => 'Per la mia nuova COLLABORAZIONE, facciamo un giro a RAPONE (PZ) in Basilicata, dove ha sede l’azienda olearia “TENUTE GIARDINO SANTO STEFANO”, produttore dell’olio EVO “L’Orocolato”.
            Ringrazio ancora il Responsabile Commerciale VITO ANGELILLO per la sua cortesia, professionalità e per quanta passione trasmette per il suo prodotto.', 'likes' => 100))
        ];

        $this->view->assign("data", $data);
    }

    function contactListAction()
    {
        $data = [
            //nome, foto, stato
        ];
    }


}
