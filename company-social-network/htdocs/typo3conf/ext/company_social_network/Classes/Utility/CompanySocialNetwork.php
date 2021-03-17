<?php


namespace Wind\Csnd\Utility;


use Wind\Csnd\Domain\Model\User;


/**
 * Class CompanySocialNetwork
 *
 * Collettore di scenari di flusso dati
 * contenenitore di funzione
 *
 * @package Wind\Csnd\Utility
 */
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
        $user = $this->getLoggedUser();

        ///logica di access token

        if (empty($user)) {
            return false;
        }

        return true;
    }

    public function getLoggedUser()
    {
        $userCookie = self::readUserCookie();

        if (empty($userCookie)) {
            return false;
        }

        /** @var User $user */
        $user = $this->userRepository->findByUid($userCookie);

        return $user;
    }

    public static function readUserCookie()
    {
        $userCookie = CompanySocialNetwork::readCookie('user');
        return $userCookie;
    }


    /**
     * @param User $userFound
     */
    public static function registerUserCookie(User $userFound)
    {
        setcookie('user', $userFound->getUid(), 0, '/', "localhost");
    }

    public static function readCookie($name)
    {
        if (empty($name)) {
            return false;
        }

        return $_COOKIE[$name];
    }

    public static function deleteCookie($cookieName)
    {
        setcookie($cookieName, "", -1, '/', "localhost");
    }


}