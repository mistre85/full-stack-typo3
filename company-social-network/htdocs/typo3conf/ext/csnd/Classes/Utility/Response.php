<?php


namespace Wind\Csnd\Utility;


use http\QueryString;

class Response
{

    const STATUS_OK = "OK";
    const STATUS_KO_GEN = "KO";
    const STATUS_KO_USR = "KO_USER_ERRATA";
    const STATUS_KO_PSW = "KO_PASSWORD_ERRATA";

    /**
     * userRepository
     *
     * @var \Wind\Csnd\Domain\Repository\UserRepository
     * @inject
     */
    protected $userRepository = null;


    /**
     * status OK
     */
    const STAUS_OK = 'ok';

    /**
     * status KO
     */
    const STAUS_KO = 'ko';

    /**
     * Setto di default lo stato ad un valore di errore generico
     * Settando la variabile a PRIVATE in modo che non possa essere manipolata dall'esterno.
     * Creero dopo i metodi di set e get
     *
     * @var string
     */
    private $status = self::STATUS_KO_GEN;

    /**
     * @var string
     */
    private $message = "";

    /**
     * @var array
     */
    private $data = [];

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    /**
     * @param string $message
     *
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    /**
     * @param mixed $data
     */
    public function addData($data)
    {


        $this->data[] = $data;
    }

    /**
     * svuto l'array Data
     */
    public function clearData()
    {
        $this->data = [];
    }

    public function toArray()
    {

        if(count($this->data) == 1){
            $this->data =$this->data[0];
        }

        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data
        ];
    }




}