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
     * pwdValidator
     *
     * @var \Wind\Csnd\Domain\Validator\UserValidator
     * @inject
     */
    protected $pwdValidator = null;

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
                $this->redirectToURI('/personal/bacheca');
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
        setcookie('user', '', -1, '/', 'typo.local');
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

    /**
     * action new
     *
     * @return void
     */
    public function listAction()
    {
        $userList = $this->userRepository->findAll();
        $this->view->assign('users', $userList);
        
    }

     /**
     * action new
     *
     * @return void
     */
    public function importCSVAction()
    {
        //var_dump($_FILES);

        $uploadedFile = $_FILES ['tx_csnd_web_csndcnsadmin'] ['tmp_name'] ['file'];

        $content = file_get_contents($uploadedFile);
        //var_dump($content);        
        // converto il file in stringa
        $records = explode(PHP_EOL, $content);
        
        //var_dump($records);

        
        // inserisco nel DB
        foreach ($records as $record){
            
            $useArray = explode(",", $record);
//            var_dump($useArray);
            /** @var User $userExist */
            // qui verifico che la username non sia già esistente nel repository (tabella)
            $userExist = $this->userRepository->findByUsername($useArray[3])->current();
            
            if(!empty($userExist)){
                $utentiPresenti[] = $userExist;
            }
            else {

                // istanzio una nuova classe per "settare" i campi da inserire poi in tabella
                $newUser = new User();
                $newUser->setNome($useArray[0]);
                $newUser->setCognome($useArray[1]);
                $newUser->setEmail($useArray[2]);
                $newUser->setUsername($useArray[3]);
                $newUser->setPassword(mt_rand());

                // sto aggiungendo al repository (tabella del DB) l'oggeto che mi sono preparato
                $this->userRepository->add($newUser);

                $utentiNuovi[] = $newUser;
                
                //$this->persistenceManager->persistAll(); 
            }                  
        }

        $this->view->assign('newUsers', $utentiNuovi);
        $this->view->assign('userAlreadyExist', $utentiPresenti);        
    }

    /**
     * action new
     *
     * @return void
     */
    public function importFormAction()
    {
       
        
    }

    /**
     * edit new
     *
     * @return void
     */
    public function editAction()
    {
       $user = $this->csn->getLoggedUser();
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
            
        $this->addFlashMessage('Dati modificati correttamente', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->userRepository->update($user);
        $this->redirect('edit');
    }


}
