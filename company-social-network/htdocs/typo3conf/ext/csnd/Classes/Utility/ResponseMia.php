<?php

namespace Wind\Csnd\Utility;

class ResponseMia
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