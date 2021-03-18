<?php
namespace Windtre\Csnd\Controller;

use TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use Windtre\CompanySocialNetwork\Utility\CompanySocialNetwork;
use Windtre\Csnd\Domain\Model\Post;
use Windtre\Csnd\Domain\Model\User;

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
 * PostController
 */
class PostController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * postRepository
     * 
     * @var \Windtre\Csnd\Domain\Repository\PostRepository
     * @inject
     */
    protected $postRepository = null;

    /**
     * userRepository
     *
     * @var \Windtre\Csnd\Domain\Repository\UserRepository
     * @inject
     */
    protected $userRepository = null;

    /**
     * @var \Windtre\CompanySocialNetwork\Utility\CompanySocialNetwork
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
        $posts = $this->postRepository->findAll();
        $this->view->assign('posts', $posts);
    }

    /**
     * action show
     * 
     * @param \Windtre\Csnd\Domain\Model\Post $post
     * @return void
     */
    public function showAction(\Windtre\Csnd\Domain\Model\Post $post)
    {
        $this->view->assign('post', $post);
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
     * @param \Windtre\Csnd\Domain\Model\Post $newPost
     * @return void
     */
    public function createAction(\Windtre\Csnd\Domain\Model\Post $newPost)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->postRepository->add($newPost);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \Windtre\Csnd\Domain\Model\Post $post
     * @ignorevalidation $post
     * @return void
     */
    public function editAction(\Windtre\Csnd\Domain\Model\Post $post)
    {
        $this->view->assign('post', $post);
    }

    /**
     * action update
     * 
     * @param \Windtre\Csnd\Domain\Model\Post $post
     * @return void
     */
    public function updateAction(\Windtre\Csnd\Domain\Model\Post $post)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->postRepository->update($post);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \Windtre\Csnd\Domain\Model\Post $post
     * @return void
     */
    public function deleteAction(\Windtre\Csnd\Domain\Model\Post $post)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->postRepository->remove($post);
        $this->redirect('list');
    }

    /**
     * action post
     *
     * @return void
     */
    public function postAction()
    {
        $posts = $this->postRepository->findAll();
    }

    /**
     * action publicPost
     *
     * @param \Windtre\Csnd\Domain\Model\Post $newPost
     * @return void
     */
    public function savepostAction(\Windtre\Csnd\Domain\Model\Post $newPost)
    {
        /** @var CompanySocialNetwork $user */
        $user = $this->csn->getLoggedUser();

        /** @var QueryResult $utenteLoggato */
        $utenteLoggato = $this->userRepository->findByUsername($user->getUsername());
        $newPost->setUser($utenteLoggato->getFirst());
        $this->postRepository->add($newPost);
        $this->redirectToUri('area-personale/bacheca');
    }

    /**
     * @param int $postuid
     */
    public function likeAction($postuid)
    {
        //todo: rivedere il modello di dominio

        /** @var Post $newlike */
        $newlike = $this->postRepository->findByUid($postuid);
        $sumlikes = ($newlike->getLikes()+count($postuid));

        $newlike->setLikes($sumlikes);
        $this->postRepository->update($newlike);

        $this->redirect('post');
    }
}
