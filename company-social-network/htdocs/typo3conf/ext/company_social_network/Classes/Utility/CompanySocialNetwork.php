<?php


namespace Wind\Csnd\Utility;


use Wind\Csnd\Domain\Model\User;
use Wind\Csnd\Exception\UserNotExistCookieException;

class CompanySocialNetwork
{
    /**
     * userRepository
     *
     * @var \Wind\Csnd\Domain\Repository\UserRepository
     * @inject
     */
    protected $userRepository = null;


    /**
     * Controlla il cookie e verifica se l'utente esiste
     * @return boolean
     */
    public function isUserLogged()
    {
        $userCookie = $this->readUserCookie();

        if (empty($userCookie)) {
            return false;
        }

        /** @var User $user */
        $user = $this->userRepository->findByUid($userCookie);

        if (empty($user)) {
            return false;
        }

        return true;

    }

    /**
     * @param \Wind\Csnd\Domain\Model\User $user
     */
    public static function registerUserCookie(User $user)
    {
        CompanySocialNetwork::registerCookie('user', $user->getUid());
    }

    public function readUserCookie()
    {
        $userCookie = CompanySocialNetwork::readCookie('user');
        return $userCookie;
    }

    public static function readCookie($name)
    {
        return $_COOKIE[$name];
    }

    public static function registerCookie($cookieName, $data)
    {
        setcookie($cookieName, $data, 0, '/', "localhost");
        //setrawcookie($cookieName, $data, 0, '/', "localhost");
    }

    public static function deleteCookie($cookieName)
    {
        setcookie($cookieName, "", -1, '/', "localhost");
    }

}