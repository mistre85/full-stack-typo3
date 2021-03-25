<?php

namespace Windtre\CompanySocialNetwork\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use Windtre\CompanySocialNetwork\Utility\CompanySocialNetwork;
use Windtre\Csnd\Domain\Model\Post;
use Windtre\Csnd\Domain\Model\User;

class LikeButtonTextViewHelper extends AbstractViewHelper
{
    /**
     * @param \Windtre\Csnd\Domain\Model\Post $post
     * @param string $then
     * @param string $else
     * @return string
     */
    public function render(Post $post, $then, $else)
    {
        /** @var User $userUid */
        $userUid = CompanySocialNetwork::readCookie('user');
        foreach( $post->getLikes() as $like ) {
            if( $userUid == $like->getUid() ) {
                return $then;
            }
        }
        return $else;
    }

}