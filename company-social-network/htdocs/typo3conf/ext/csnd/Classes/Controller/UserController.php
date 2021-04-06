<?php

namespace Wind\Csnd\Controller;

use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
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
        /** @var User $user */
        $user = $this->csn->getLoggedUser();
        $user->setOnline(false);
        $this->userRepository->update($user);
        setcookie('user', '', -1, '/', 'localhost');
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

    /**
     * ripristinata per evitare problema nel BE
     */
    public function listAction()
    {
        $users = $this->userRepository->findAll();
        $this->view->assign('users', $users);
    }

    public function importCSVAction()
    {

        //ricevere il file dal form
        //-- php / form html - typo3 ci può aiutare

        $uploadedFile = $_FILES['tx_csnd_web_csndcnsadmin']['tmp_name']['file'];
        $content = file_get_contents($uploadedFile);


        //cosa fa typo3 in merito?
        // -- conversione CVS?
        // -- i file uplodati dove vanno a finire?

        //converire il file in stringa e elaborarlo
        $records = explode(PHP_EOL, $content);


        $insertedUsers = [];
        $skippedUsers = [];
        //inserire nel DB
        // -- inseriamo solo nuovi utenti
        // -- esiste o no l'utente? lo scarto? mostro un errore?
        foreach ($records as $record) {

            $userArray = explode(',', $record);

            $existingUser = $this->userRepository->findByUsername($userArray[3])->current();

            if (!empty($existingUser)) {
                $skippedUsers[] = $existingUser;
            } else {

                $newUser = new User();
                $newUser->setNome($userArray[0]);
                $newUser->setCognome($userArray[1]);
                $newUser->setEmail($userArray[2]);
                $newUser->setUsername($userArray[3]);
                $newUser->setPassword(md5(rand(1000, 9999)));

                $this->userRepository->add($newUser);

                //avete lo stesso oggetto del DB

                $insertedUsers[] = $newUser;
            }
        }

        $this->view->assign('insertedUsers', $insertedUsers);
        $this->view->assign('skippedUsers', $skippedUsers);


    }

    public function importFormAction()
    {

        //vedere il form in pagina
    }

}
