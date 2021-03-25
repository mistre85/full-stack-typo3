<?php

namespace Wind\Csnd\Utility;

class Response{

    const STATUS_OK = 'ok';
    const STATUS_KO = 'ko';

    /**
     * contains status of response
     * ok - the api flow is the "corretc" flow
     * ko - the api flow contains handled error scenario
     * @var string
     */

    private $status = self::STATUS_KO;

    /**
     * contains the description message of response 
    * for the client
    * @var string
    */
    private $message = "";

    /**
     * contains additiona flow data
     * @var array 
     */
    private $data = [];

    /**
     * return status
     * @return string
     */
    public function getStatus(){
        return $this->status;
    }

    /**
     * return status
     * @return string
     */
    public function getMessage(){
        return $this->message;
    }

    /**
    * set message infor
    * @param string $message
    */
    public function setMessage(string $message){
        $this->message = $message; 
    }

    /**
    * set status infor
    * @param string $status
    */
    public function setStatus(string $status){
        
        $this->emptyResponse = false;
        $this->status = $status; 
    }

    /**
     * Adds a flow data information to response
     * @param mixed $data 
     */
    public function addData($data){

        $this->emptyResponse = false;
        $this->data[] = $data; 
    }

    /**
     * clear all response additional data
     * 
     */
    public function clearData(string $data){
        $this->data = []; 
    }

    /**
     * @param string $message
     * @param boolean $eol
     * @param string|mixed $eolElement
     * 
     */
    public function addMessage(string $message, $eol = false, $eolElement = ""){
       
        $this->message .= $message;

        if ($eol) {

            $this->message .= $eolElement;
        }else{
            $this->message .= $message;
        }
    }

    /**
     * clean the string message with empty string
    */
    public function cleanMessage(){

        $this->message = "";
    }

    /**
     * 
     * @return array
     */
    public function toArray(){

        if ($this->emptyResponse){
            return [];
        }

        if (count($this->data) == 1 ){
            $this->data = $this->data[0];
        }

        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data
        ];
    }        
}