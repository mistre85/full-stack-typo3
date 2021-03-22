<?php

namespace Wind\Csnd\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use Wind\Csnd\Domain\Model\Post;
use Wind\Csnd\Domain\Model\User;
use Wind\Csnd\Utility\CompanySocialNetwork;


class LikeButtonTextViewHelper extends AbstractViewHelper
{

    /*
     * CompanySocialNetwork
     *
     * @var \Wind\Csnd\Utility\CompanySocialNetwork
     * @inject
     */
    //protected $csn = null;

    /**
     * @param $post \Wind\Csnd\Domain\Model\Post
     * @param $then string
     * @param $else string
     * @return string
     */
    public function render(Post $post, $then, $else)
    {

        /*
         * @var User $user
         */
        //$user = $this->csn->getLoggedUser();
        //uso il valore intero del cookie (uid) salvato direttamente nel cookie
        $userUid = CompanySocialNetwork::readUserCookie();

        foreach ($post->getLikes() as $like) {
            if ($userUid == $like->getUid()) {
                return $then;
            }
        }

        return $else;

    }


}