<?php
namespace Wind\Csnd\Controller;

use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;
use Wind\Csnd\Domain\Model\User;
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
     * CompanySocialNetwork
     *
     * @var \Wind\Csnd\Utility\CompanySocialNetwork
     * @inject
     */
    protected $csn = null;

    /**
     * action register
     *
     * @return void
     */
    public function registerAction()
    {

    }

    /**
     * action login
     *
     * @return void
     */
    public function loginAction()
    {

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
            $this->addFlashMessage('Non ti abbiamo trovato! riprova', 'Login fallito', FlashMessage::ERROR);
            $this->redirect('login');
        } else {
            if ($newUser->getPassword() == $userFound->getPassword()) {
                $userFound->setOnline(true);
                $this->userRepository->update($userFound);
                CompanySocialNetwork::registerUserCookie($userFound);
                $this->addFlashMessage('Benvenuto', 'Login avvenuta con successo');
                $this->redirectToURI('/personal/dashboard');
            } else {
                $this->addFlashMessage('utente o password errata,riprova', 'Login fallito', FlashMessage::ERROR);
                $this->redirect('login');
            }
        }
    }

    /**
     * action logout
     *
     * @return void
     */
    function logoutAction()
    {
        //unset($_COOKIE['user']);
        CompanySocialNetwork::deleteCookie('user');
        $user = $this->csn->getLoggedUser();
        $user->setOnline(false);
        $this->userRepository->update($user);

        $this->redirectToUri('/');
    }

    /**
     * action subscription
     *
     * @param \Wind\Csnd\Domain\Model\User $newUser
     * @return void
     */
    public function subscriptionAction(\Wind\Csnd\Domain\Model\User $newUser)
    {
        $this->addFlashMessage('Registrazione avvenuta con successo.', 'Benvenuto in CSN', FlashMessage::OK);
        $this->userRepository->add($newUser);
        $this->redirectToUri('/login');
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {

    }

    public function statusAction()
    {
        $user = $this->csn->getLoggedUser();
        $this->view->assign('user', $user);
    }


    public function toggleStatusAction()
    {
        $user = $this->csn->getLoggedUser();
        $user->setOnline(!$user->getOnline());
        $this->userRepository->update($user);
        $this->view->assign('user', $user);
    }



}
