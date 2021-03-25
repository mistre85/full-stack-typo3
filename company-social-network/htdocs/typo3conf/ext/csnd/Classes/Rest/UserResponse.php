<?php


namespace Wind\Csnd\Rest;


use Wind\Csnd\Domain\Model\User;

class UserResponse extends Response
{

    /**
     *
     * @param mixed $user
     */
    public function addData($user)
    {
        if ($user instanceof Wind\Csnd\Domain\Model\User) {
            $userResponse = [
                'id' => $user->getUid(),
                'online' => $user->getOnline()
            ];
        } else {
            $userResponse = $user;
        }

        parent::addData($userResponse);

    }
}