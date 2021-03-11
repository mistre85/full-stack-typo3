<?php

namespace Wind\Csnd\Controller;

use http\Cookie;
use TYPO3\CMS\Core\Log\Logger;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;
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
 * UserController
 */
class UserController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * userRepository
     *
     * @var \Wind\Csnd\Domain\Repository\UserRepository
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
     * @param \Wind\Csnd\Domain\Model\User $user
     * @return void
     */
    public function showAction(\Wind\Csnd\Domain\Model\User $user)
    {
        $this->view->assign('user', $user);
    }

    /**
     * action edit
     *
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
     *
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
     *
     * @param \Wind\Csnd\Domain\Model\User $user
     * @return void
     */
    public function deleteAction(\Wind\Csnd\Domain\Model\User $user)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->userRepository->remove($user);
        $this->redirect('list');
    }

    //custom action

    /**
     * action register
     *
     * @return void
     */
    public function registerAction()
    {
        //registration Form
    }

    /**
     * action login
     *
     * @return void
     */
    public function loginAction()
    {
        //login form
    }


    /**
     * action doLogin
     *
     * @param \Wind\Csnd\Domain\Model\User $newUser
     * @ignorevalidation $newUser
     * @return void
     */
    public function doLoginAction(\Wind\Csnd\Domain\Model\User $newUser)
    {

        /** @var QueryResult $query */
        $query = $this->userRepository->findByUsername($newUser->getUsername());

        /** @var User $userFound */
        $userFound = $query->getFirst();

        if (empty($userFound)) {

            $this->addFlashMessage('Non ti abbiamo trovato! riprova', "Login fallito", FlashMessage::ERROR);
            $this->redirect('login');
        } else {

            if ($newUser->getPassword() == $userFound->getPassword()) {

                $userFound->setOnline(true);
                $this->userRepository->update($userFound);
                $this->addFlashMessage("Benvenuto", "Login avvenuta con successo");
                $this->redirectToURI("/personal/dashboard");

            } else {

                $this->addFlashMessage('utente o password errata,riprova', "Login fallito", FlashMessage::ERROR);
                $this->redirect('login');
            }
        }

    }

    /**
     * action logout
     *
     * @return void
     */
    function logoutAction(\Wind\Csnd\Domain\Model\User $newUser)
    {
        $this->addFlashMessage('Arrivederci', "Logout riuscito");
        $newUser->setOnline(false);
        $this->userRepository->update($newUser);
    }

    /**
     * action subscription
     *
     * @param \Wind\Csnd\Domain\Model\User $newUser
     * @return void
     */
    public function subscriptionAction(\Wind\Csnd\Domain\Model\User $newUser)
    {
        $this->addFlashMessage("Registrazione avvenuta con successo.", "Benvenuto in CSN", FlashMessage::OK);
        $this->userRepository->add($newUser);
        $this->redirectToUri('/login');

    }
}
