<?php


namespace Wind\Csnd\Utility;


class Response
{
    /**
     * status value ok for status attribute
     */
    const STATUS_OK = 'ok';

    /**
     * status value ko for status attribute
     */
    const STATUS_KO = 'ko';

    /**
     * contains status of response
     * ok - the api flow is the "correct" flow
     * ko - the api flow contains handled error scenario
     * @var string
     */
    private $status = null;

    /**
     * contains the description message of response
     * for the client
     * @var string
     */
    private $message = "";

    /**
     * contains additional flow data
     * @var array
     */
    private $data = [];

    /**
     * handle the empty response check
     * @var bool
     */
    private $emptyResponse = true;

    /**
     * return status
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
     * set message infor
     * @param string $message
     */
    public function setMessage(string $message)
    {
        $this->emptyResponse = false;
        $this->message = $message;
    }

    /**
     * set new string status
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->emptyResponse = false;
        $this->status = $status;
    }

    /**
     * Adds a flow data inofrmation to response
     * @param mixed $data
     */
    public function addData($data)
    {
        $this->emptyResponse = false;
        $this->data[] = $data;
    }

    /**
     * clear all response additional data
     */
    public function clearData()
    {
        $this->data = [];
    }

    /**
     * @param string $message
     * @param bool $eol
     * @param string $eolElement
     */
    public function addMessage(string $message, $eol = false, $eolElement = "")
    {
        $this->message .= $message;

        if ($eol) {
            $this->message .= $eolElement;
        } else {
            $this->message .= $message;
        }
    }

    /**
     * clean the string message with empty string
     */
    public function cleanMessage()
    {
        $this->message = "";
    }

    /**
     *
     * @return array
     */
    public function toArray()
    {

        if ($this->emptyResponse) {
            return [];
        }

        if (count($this->data) == 1) {
            $this->data = $this->data[0];
        }

        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data
        ];
    }

}