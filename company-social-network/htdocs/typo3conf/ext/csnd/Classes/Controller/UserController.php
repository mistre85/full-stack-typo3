<?php
namespace Wind\Csnd\Controller;

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
 * UserController
 */
class UserController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * userRepository
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @var \Wind\Csnd\Domain\Repository\UserRepository
     * @inject
     */
    protected $userRepository = null;

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
        $users = $this->userRepository->findAll();
        $this->view->assign('users', $users);
    }

    /**
     * action show
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @param \Wind\Csnd\Domain\Model\User $user
     * @return void
     */
    public function showAction(\Wind\Csnd\Domain\Model\User $user)
    {
        $this->view->assign('user', $user);
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
     * @param \Wind\Csnd\Domain\Model\User $newUser
     * @return void
     */
    public function createAction(\Wind\Csnd\Domain\Model\User $newUser)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->userRepository->add($newUser);
        $this->redirect('list');
    }

    /**
     * action edit
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @param \Wind\Csnd\Domain\Model\User $user
     * @ignorevalidation $user
     * @return void
     */
    public function editAction(\Wind\Csnd\Domain\Model\User $user)
    {
        $this->view->assign('user', $user);
    }

    /**
     * action update
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @param \Wind\Csnd\Domain\Model\User $user
     * @return void
     */
    public function updateAction(\Wind\Csnd\Domain\Model\User $user)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->userRepository->update($user);
        $this->redirect('list');
    }

    /**
     * action delete
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
     * @param \Wind\Csnd\Domain\Model\User $user
     * @return void
     */
    public function deleteAction(\Wind\Csnd\Domain\Model\User $user)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->userRepository->remove($user);
        $this->redirect('list');
    }
}
