<?php
namespace Windtre\Csnd\Controller;

use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

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
     * action register
     *
     * @return void
     */
    public function registerAction()
    {
        // show form
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

    /**
     * action subscription
     *
     * @param \Windtre\Csnd\Domain\Model\User $newUser
     * @return void
     */
    public function subscriptionAction(\Windtre\Csnd\Domain\Model\User $newUser)
    {
        $this->addFlashMessage('Registrazione avenuta con successo', 'Benvenuto in CSN', FlashMessage::OK);
        $this->userRepository->add($newUser);
        $this->redirectToUri('/login');
        //$this->redirect('login');
    }

    /**
     * action login
     *
     * @return void
     */
    public function loginAction()
    {
        //DebuggerUtility::var_dump($GLOBALS['BE_USER']->isAdminPanelVisible());
    }

    /**
     * action doLogin
     *
     * @param \Windtre\Csnd\Domain\Model\User $newUser
     * @ignorevalidation $newUser
     * @return void
     */
    public function doLoginAction(\Windtre\Csnd\Domain\Model\User $newUser)
    {
        $query = $this->userRepository->findByUsername($newUser->getUsername());
        /** @var \Windtre\Csnd\Domain\Model\User $userFound */
        $userFound = $query->getFirst();

//        DebuggerUtility::var_dump($userFound);
//        die();

        if( empty($userFound) ) {
            $this->addFlashMessage('Non sei stato riconosciuto', 'Login fallito', FlashMessage::ERROR);
            $this->redirect('login');
        } else {
            if( $newUser->getPassword() == $userFound->getPassword() ) {
                $userFound->setOnline(true);
                $this->userRepository->update('Benvenuto', 'Login avvenuta con successo', FlashMessage::OK);
                $this->redirectToUri('area-personale/profilo/');
            } else {
                $this->addFlashMessage('Utente o password errata, riprova', 'Login fallito', FlashMessage::WARNING);
                $this->redirect('login');
            }
        }
    }
}
