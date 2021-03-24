<?php

namespace Wind\Csnd\Utility;

use ArrayObject;
use Wind\Csnd\Domain\Model\User;


/**
 * Class CompanySocialNetwork
 *
 * Collettore di scenari di flusso dati
 * contenenitore di funzione
 *
 * @package Wind\Csnd\Utility
 */
class Response
{
    protected $responseV = [];
    
    public function ResponseObj($tipo, $valore){

        if ($tipo == 'status' || $tipo=='message' || $tipo=='data'){

            $this->responseV[$tipo]=$valore;
            return true;
        }
        return false;

    }

    public function viewResp(){
        return  $this->responseV;
    }
}