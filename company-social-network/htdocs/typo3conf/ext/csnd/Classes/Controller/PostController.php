<?php
namespace Wind\Csnd\Controller;

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
}
