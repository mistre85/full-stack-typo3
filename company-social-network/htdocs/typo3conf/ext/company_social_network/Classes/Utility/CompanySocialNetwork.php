<?php

namespace Windtre\CompanySocialNetwork\Utility;

class CompanySocialNetwork
{
    /**
     * userRepository
     *
     * @var \Windtre\Csnd\Domain\Repository\UserRepository
     * @inject
     */
    protected $userRepository = null;

    /**
     * @param \Windtre\Csnd\Domain\Model\User $user
     */
    public static function registerCookie($user)
    {
        setcookie('user', $user->getUid(), 0, '/', 'csn.local');
    }

    public static function readCookie($name)
    {
        if( empty($name) ) {
            return false;
        }
        return $_COOKIE[$name];
    }

}