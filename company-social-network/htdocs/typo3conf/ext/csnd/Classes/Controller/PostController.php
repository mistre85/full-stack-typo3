<?php
namespace Wind\Csnd\Controller;

<<<<<<< HEAD
=======
use Wind\Csnd\Domain\Repository\PostRepository;
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
/***
 *
 * This file is part of the "Company Social Network Data" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
<<<<<<< HEAD
 *  (c) 2021 
=======
 *  (c) 2021
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
 *
 ***/

/**
 * PostController
 */
class PostController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * postRepository
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @var \Wind\Csnd\Domain\Repository\PostRepository
     * @inject
     */
    protected $postRepository = null;

    /**
     * action list
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @return void
     */
    public function listAction()
    {
        $posts = $this->postRepository->findAll();
        $this->view->assign('posts', $posts);
    }

    /**
     * action show
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @param \Wind\Csnd\Domain\Model\Post $post
     * @return void
     */
    public function showAction(\Wind\Csnd\Domain\Model\Post $post)
    {
        $this->view->assign('post', $post);
    }

    /**
     * action new
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @return void
     */
    public function newAction()
    {

    }

    /**
     * action create
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
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
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
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
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
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
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
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
