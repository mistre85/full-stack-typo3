<?php

namespace Wind\Csnd\Rest;


use Cundd\Rest\Handler\HandlerInterface;
use Cundd\Rest\Http\RestRequestInterface;
use Cundd\Rest\Router\Route;
use Cundd\Rest\Router\RouterInterface;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use Wind\Csnd\Domain\Model\User;
use Wind\Csnd\Utility\CompanySocialNetwork;



class UserHandler implements HandlerInterface
{

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     * @inject
     *
     */
    private $persistenceManager = null;

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
     *
     * @var \Wind\Csnd\Utility\UserResponse
     * ß
     * @inject
     *
     */
    protected $response = null;

    /**
     * @param RouterInterface $router
     * @param RestRequestInterface $request
     */

    public function configureRoutes(RouterInterface $router, RestRequestInterface $request)
    {
        $router->add(
            Route::post(
                $request->getResourceType() . '/login',
                function (RestRequestInterface $request) {

                    $data = $request->getSentData();
                    /** @var User $user */
                    $user = $this->userRepository->findByUsername($data['username'])->current();
                    if ($user) {
                        if ($user->getPassword() == $data['password']) {

                            CompanySocialNetwork::registerUserCookie($user);
                            $user->setOnline(!$user->getOnline());
                            $this->userRepository->update($user);
                            $this->persistenceManager->persistAll();

                            $this->response->setStatus('OK');
                            $this->response->setMessage('Login effettuata correttamente');

                        } else {
                            $this->response->setStatus('PSW Errata');
                            $this->response->setMessage('La password non é corretta');
                        }
                    } else {
                        $this->response->setStatus('No User');
                        $this->response->setMessage('Utente non trovato');
                    }
                    return $this->response->toArray();
                }
            )
        );


        $router->add(
            Route::post(
                $request->getResourceType() . '/dashboard',
                function (RestRequestInterface $request) {
                    $user = $this->csn->getLoggedUser();
                    $user->setOnline(!$user->getOnline());
                    $this->userRepository->update($user);
                    $this->persistenceManager->persistAll();
                    return $user->getOnline();
                }
            )
        );


        $router->add(
            Route::get(
                $request->getResourceType() . '/getUserStatus',
                function (RestRequestInterface $request) {
                    $users = $this->userRepository->findAll();
                    /** @var User $user */
                    foreach ($users as $user) {
                        /*
                        $this->response->addData(
                            [
                                'UserId' => $user->getUid(),
                                'status' => $user->getOnline()
                            ]);
                        */
                        $this->response->addData($user);
                    }
                    $this->response->setStatus('OK');

                    return $this->response->toArray();

                }

            )
        );


    }

}