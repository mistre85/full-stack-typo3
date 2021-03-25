<?php


namespace Windtre\CompanySocialNetwork\Utility;


class ApiResponse
{
    /**
     * @var string $status
     */
    protected $status;

    /**
     * @var string $message
     */
    protected $message;

    /**
     * @var array|mixed $data
     */
    protected $data;

    /**
     * @return string
     */
    protected function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    protected function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    /**
     * @return array|mixed
     */
    protected function getData()
    {
        return $this->data;
    }

    /**
     * @param array|mixed $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function sendResponse()
    {
        return [
            'status'    => $this->getStatus(),
            'message'   => $this->getMessage(),
            'data'      => $this->getData(),
        ];
    }
}