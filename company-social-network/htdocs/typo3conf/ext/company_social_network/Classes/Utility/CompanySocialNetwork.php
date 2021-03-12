<?php


namespace Wind\Csnd\Utility;
use Wind\Csnd\Domain\Model\User;

class CompanySocialNetwork{

    public static function registerUserCookie(User $userFound){
    
        setcookie('user', $userFound->getUid(), 0, '/', "typo.local");
    }


}