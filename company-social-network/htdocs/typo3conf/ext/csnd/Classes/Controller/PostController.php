<?php

namespace Wind\Csnd\Controller;

use TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;
use Wind\Csnd\Domain\Model\Post;
use Wind\Csnd\Domain\Model\User;
use Wind\Csnd\Domain\Repository\PostRepository;
use Wind\Csnd\Utility\CompanySocialNetwork;

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
     * @var \Wind\Csnd\Domain\Repository\PostRepository
     * @inject
     */
    protected $postRepository = null;

    /**
     * userRepository
     *
     * @var \Wind\Csnd\Domain\Repository\UserRepository
     * @inject
     */
    protected $userRepository = null;


    /**
     * CompanySocialNetwork
     *
     * @var \Wind\Csnd\Utility\CompanySocialNetwork
     * @inject
     */
    protected $csn = null;


    /**
     * action list
     * @format json
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
     * @param \Wind\Csnd\Domain\Model\Post $post
     * @return void
     */
    public function showAction(\Wind\Csnd\Domain\Model\Post $post)
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
     * @param \Wind\Csnd\Domain\Model\Post $newPost
     * @return void
     */
    public function createAction(\Wind\Csnd\Domain\Model\Post $newPost)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->postRepository->add($newPost);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Wind\Csnd\Domain\Model\Post $post
     * @ignorevalidation $post
     * @return void
     */
    public function editAction(\Wind\Csnd\Domain\Model\Post $post)
    {
        $this->view->assign('post', $post);
    }

    /**
     * action update
     *
     * @param \Wind\Csnd\Domain\Model\Post $post
     * @return void
     */
    public function updateAction(\Wind\Csnd\Domain\Model\Post $post)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->postRepository->update($post);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Wind\Csnd\Domain\Model\Post $post
     * @return void
     */
    public function deleteAction(\Wind\Csnd\Domain\Model\Post $post)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->postRepository->remove($post);
        $this->redirect('list');
    }

    /**
     * post action
     *
     * @return void
     */
    public function postAction()
    {

    }

    /**
     * action create
     *
     * @param \Wind\Csnd\Domain\Model\Post $newPost
     * @ignorevalidation
     * @return void
     */
    public function publicPostAction(\Wind\Csnd\Domain\Model\Post $newPost)
    {
        $userId = CompanySocialNetwork::readCookie('user');
        /** @var User $utenteLoggato */
        $utenteLoggato = $this->userRepository->findByUid($userId);
        $newPost->setUser($utenteLoggato);
        $this->postRepository->add($newPost);
        $this->redirectToURI('/personal/dashboard');
    }

    /**
     * @param int $postUid
     */
    public function likeAction(int $postUid)
    {
        //utente che fa il mi piace (??) --> //todo: rivedere il modello di dominio
        $user = $this->csn->getLoggedUser();

        //assegnare il mi piace a quel post
        /** @var Post $postToLike */
        $postToLike = $this->postRepository->findByUid($postUid);

        /** @var User $like */
        $userFound = false;
        foreach ($postToLike->getLikes() as $like) {
            if ($like->getUid() == $user->getUid()) {
                $userFound = true;
                break;
            }
        }

        if ($userFound) {
            $postToLike->removeLike($user);
        } else {
            $postToLike->addLike($user);
        }

        $this->postRepository->update($postToLike);

        $this->redirectToUri('/personal/dashboard');
    }

}
