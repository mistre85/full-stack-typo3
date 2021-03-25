<?php

namespace Wind\Csnd\Rest;


use Cundd\Rest\Handler\HandlerInterface;
use Cundd\Rest\Http\RestRequestInterface;
use Cundd\Rest\Router\Route;
use Cundd\Rest\Router\RouterInterface;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use Wind\Csnd\Domain\Model\User;
use Wind\Csnd\Utility\CompanySocialNetwork;
use Wind\Csnd\Utility\ResponseManager;

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
     * @param RouterInterface $router
     * @param RestRequestInterface $request
     */

    public function configureRoutes(RouterInterface $router, RestRequestInterface $request)
    {
        $router->add(
            Route::post(
                $request->getResourceType() . '/login',
                function (RestRequestInterface $request) {
                    /*
                        return [
                        'path' => $request->getPath(),
                        'uri' => (string)$request->getUri(),
                        'resourceType' => (string)$request->getResourceType(),
                        'data' => $request->getSentData(),
                    ];
                    */
                    $data = $request->getSentData();
                    /** @var User $user */
                    $user = $this->userRepository->findByUsername($data['username'])->current();
                    if ($user) {
                        if ($user->getPassword() == $data['password']) {
                            CompanySocialNetwork::registerUserCookie($user);
                            $response = ResponseManager::responseStatus('OK', 'Login effettuata correttamente', $user->getUid());
                            //$response['status'] = "OK";
                            //$response['data']['uid'] = $user->getUid();
                            //$response['messages'] = "Login effettuata correttamente";
                            $user->setOnline(!$user->getOnline());
                            $this->userRepository->update($user);
                            $this->persistenceManager->persistAll();
                        } else {
                            $response = ResponseManager::responseStatus('PSW Errata', 'La password non e corretta', '');
                            //$response['status'] = "PSW Errata";
                            //$response['messages'] = "La password non e corretta";
                        }
                    } else {
                        $response = ResponseManager::responseStatus('No User', 'Utente non trovato', '');
                        //$response['status'] = "No User";
                        //$response['messages'] = "Utente non trovato";
                    }

                    return $response;
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


    }

}