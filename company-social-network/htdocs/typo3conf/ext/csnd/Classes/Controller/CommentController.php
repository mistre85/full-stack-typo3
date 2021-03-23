<?php

namespace Wind\Csnd\Controller;

use http\Client\Curl\User;
use Wind\Csnd\Domain\Model\Comment;
use Wind\Csnd\Domain\Model\Post;

/***
 *
 * This file is part of the "Company Social Network Data" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2021
 *
 ***/

/**
 * CommentController
 */
class CommentController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * commentRepository
     *
     * @var \Wind\Csnd\Domain\Repository\CommentRepository
     * @inject
     */
    protected $commentRepository = null;

    /**
     * postRepository
     *
     * @var \Wind\Csnd\Domain\Repository\PostRepository
     * @inject
     */
    protected $postRepository = null;

    /**
     * postRepository
     *
     * @var \Wind\Csnd\Utility\CompanySocialNetwork
     * @inject
     */
    protected $csn = null;

    /**
     * action create
     *
     * @param \Wind\Csnd\Domain\Model\Comment $newComment
     * @param int $postUid
     * @return void
     */
    public function createAction(\Wind\Csnd\Domain\Model\Comment $newComment, $postUid)
    {
        /** @var Post $post */
        $post = $this->postRepository->findByUid($postUid);
        $loggedUser = $this->csn->getLoggedUser();

        $newComment->setUser($loggedUser);
        $post->addComment($newComment);

        $this->postRepository->update($post);
        $this->redirectToUri('personal/dashboard');
    }

    /**
     * action remove
     *
     * @param \Wind\Csnd\Domain\Model\Comment $remComment
     * @param int $postUid
     * @param int $commentUid
     */
    public function removeAction(\Wind\Csnd\Domain\Model\Comment $remComment, $postUid, int $commentUid)
    {

        /** @var Post $post */
        /** @var Comment $remComment */

        $post = $this->postRepository->findByUid($postUid);

        $remComment= $this->commentRepository->findByUid($commentUid);
        $userIdpost=$remComment->getUser()->getUid();

        $loggedUser = $this->csn->getLoggedUser();
        if( $loggedUser->getUid() == $userIdpost){
            $post->removeComment($remComment);
            $this->postRepository->update($post);
        }else{

        }
        $this->redirectToUri('personal/dashboard');
    }
}
