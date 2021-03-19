<?php

namespace Wind\Csnd\Controller;

use Wind\Csnd\Domain\Model\Comment;
use Wind\Csnd\Domain\Model\Post;
use Wind\Csnd\Domain\Model\User;

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
    protected $cns = null;


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

        /** @var User $loggedUser */
        $loggedUser = $this->cns->getLoggedUser();

        $newComment->setUser($loggedUser);

        $post->addComment($newComment);

        $this->postRepository->update($post);
        // ---> (in teoria) a cascata $this->commentRepository->add($newComment); --> $this->commentRepository->update($newComment);


        $this->redirectToUri('personal/dashboard');

    }

}
