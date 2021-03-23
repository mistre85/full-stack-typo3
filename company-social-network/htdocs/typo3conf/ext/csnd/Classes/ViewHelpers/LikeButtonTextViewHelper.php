<?php


namespace Wind\Csnd\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use Wind\Csnd\Domain\Model\Post;
use Wind\Csnd\Domain\Model\User;
use Wind\Csnd\Utility\CompanySocialNetwork;

class LikeButtonTextViewHelper extends AbstractViewHelper
{

    /**
     * postRepository
     *
     * @var \Wind\Csnd\Utility\CompanySocialNetwork
     * @inject
     */
    protected $csn = null;


    /**
     * @param $post \Wind\Csnd\Domain\Model\Post
     * @param $then string
     * @param $else string
     *
     * @return mixed|null
     */
    public function render(\Wind\Csnd\Domain\Model\Post $post, $then, $else)
    {

        $userId = CompanySocialNetwork::readUserCookie();

        /** @var User $user */
        /** @var User $like */
        foreach ($post->getLikes() as $like) {
            if ($userId == $like->getUid()) {
                return $then;
            }
        }

        return $else;

    }

}