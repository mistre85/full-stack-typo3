<?php
namespace Windtre\Csnd\Controller;

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
 * UserController
 */
class UserController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * userRepository
     * 
     * @var \Windtre\Csnd\Domain\Repository\UserRepository
     * @inject
     */
    protected $userRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $users = $this->userRepository->findAll();
        $this->view->assign('users', $users);
    }

    /**
     * action show
     * 
     * @param \Windtre\Csnd\Domain\Model\User $user
     * @return void
     */
    public function showAction(\Windtre\Csnd\Domain\Model\User $user)
    {
        $this->view->assign('user', $user);
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
     * @param \Windtre\Csnd\Domain\Model\User $newUser
     * @return void
     */
    public function createAction(\Windtre\Csnd\Domain\Model\User $newUser)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->userRepository->add($newUser);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \Windtre\Csnd\Domain\Model\User $user
     * @ignorevalidation $user
     * @return void
     */
    public function editAction(\Windtre\Csnd\Domain\Model\User $user)
    {
        $this->view->assign('user', $user);
    }

    /**
     * action update
     * 
     * @param \Windtre\Csnd\Domain\Model\User $user
     * @return void
     */
    public function updateAction(\Windtre\Csnd\Domain\Model\User $user)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->userRepository->update($user);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \Windtre\Csnd\Domain\Model\User $user
     * @return void
     */
    public function deleteAction(\Windtre\Csnd\Domain\Model\User $user)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->userRepository->remove($user);
        $this->redirect('list');
    }
}
