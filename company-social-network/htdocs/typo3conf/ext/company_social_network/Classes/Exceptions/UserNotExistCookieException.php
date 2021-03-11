<?php


namespace Wind\Csnd\Exception;


class UserNotExistCookieException extends \Exception
{
    public function __construct($message = "")
    {
        parent::__construct($message);
    }


}