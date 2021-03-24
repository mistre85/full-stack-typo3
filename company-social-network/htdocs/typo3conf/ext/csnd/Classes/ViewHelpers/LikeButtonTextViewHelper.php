<?php

namespace Wind\Csnd\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use Wind\Csnd\Domain\Model\Post;
use Wind\Csnd\Utility\CompanySocialNetwork;


class LikeButtonTextViewHelper extends AbstractViewHelper
{

    //rimosso perchè non mi serve tutto l'oggetto
    /*
     * CompanySocialNetwork
     *
     * @var \Wind\Csnd\Utility\CompanySocialNetwork
     * @inject
     */
    //protected $csn = null;

    /**
     * @param \Wind\Csnd\Domain\Model\Post $post
     * @param string $then
     * @param string $else
     * @return string
     */
    public function render(Post $post, string $then, string $else)
    {

        /*
         * @var User $user
         */
        //$user = $this->csn->getLoggedUser();
        //uso il valore intero del cookie (uid) salvato direttamente nel cookie
        //come ottimizzazione

        $userUid = CompanySocialNetwork::readUserCookie();

        foreach ($post->getLikes() as $like) {
            if ($userUid == $like->getUid()) {
                return $then;
            }
        }

        return $else;

    }


}