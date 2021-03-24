<?php
namespace Wind\Csnd\Controller;

use Wind\Csnd\Domain\Repository\PostRepository;
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
     * CompanySocialNetwork
     *
     * @var \Wind\Csnd\Utility\CompanySocialNetwork
     * @inject
     */
    protected $csn = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $comments = $this->commentRepository->findAll();
        $this->view->assign('comments', $comments);
    }

    /**
     * action show
     *
     * @param \Wind\Csnd\Domain\Model\Comment $comment
     * @return void
     */
    public function showAction(\Wind\Csnd\Domain\Model\Comment $comment)
    {
        $this->view->assign('comment', $comment);
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {

    }

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

        $this->redirectToUri('personal/bacheca');
    }

    /**
     * action edit
     *
     * @param \Wind\Csnd\Domain\Model\Comment $comment
     * @ignorevalidation $comment
     * @return void
     */
    public function editAction(\Wind\Csnd\Domain\Model\Comment $comment)
    {
        $this->view->assign('comment', $comment);
    }

    /**
     * action update
     *
     * @param \Wind\Csnd\Domain\Model\Comment $comment
     * @return void
     */
    public function updateAction(\Wind\Csnd\Domain\Model\Comment $comment)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->commentRepository->update($comment);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Wind\Csnd\Domain\Model\Comment $comment
     * @return void
     */
    public function deleteAction(\Wind\Csnd\Domain\Model\Comment $comment)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->commentRepository->remove($comment);
        //$this->redirect('list');
        $this->redirectToUri('personal/bacheca');
    }

    /**
     * action remove
     *
     * @param \Wind\Csnd\Domain\Model\Comment $comment
     * @param int $postUid
     * @return void
     */

    public function removeAction($postUid)
    {
        
    }


    
    /**
     * action
     *
     * @return void
     */
    public function Action()
    {

    }
}
