<?php


namespace Wind\Csnd\Utility;


class UserResponse extends Response
{

    public function addData( \Wind\Csnd\Domain\Model\User $user)
    {

        $userResponse = [
            'id' => $user->getUid(),
            'online' => $user->getOnline()
        ];
        parent::addData($userResponse);
    }
}