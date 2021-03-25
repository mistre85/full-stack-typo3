<?php


namespace Wind\Csnd\Rest;


use Wind\Csnd\Domain\Model\User;

class UserResponse extends Response
{

    /**
     *
     * @param User $user
     */
    public function addData(\Wind\Csnd\Domain\Model\User $user)
    {
        $userResponse = [
            'id' => $user->getUid(),
            'online' => $user->getOnline()
        ];

        parent::addData($userResponse);

    }
}