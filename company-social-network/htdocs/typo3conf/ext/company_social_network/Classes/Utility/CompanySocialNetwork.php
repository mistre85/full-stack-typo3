<?php

namespace Windtre\CompanySocialNetwork\Utility;

use Windtre\Csnd\Domain\Model\User;

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

    public static function deleteCookie()
    {
        setcookie('user', '', -1, '/', 'csn.local');
    }

    public function getLoggedUser()
    {
        /** @var User $user */
        $usercookie = CompanySocialNetwork::readCookie('user');
        $user = $this->userRepository->findByUid($usercookie);
        return $user;
    }
}