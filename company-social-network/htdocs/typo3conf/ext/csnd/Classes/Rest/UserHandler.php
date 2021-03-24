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
     * userRepository
     *
     * @var \Wind\Csnd\Domain\Repository\UserRepository
     * @inject
     */
    protected $userRepository = null;


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
                            $response['status'] = "OK";
                            $response['data']['uid'] = $user->getUid();
                            $response['messages'] = "Login effettuata correttamente";
                        } else {
                            $response['status'] = "PSW Errata";
                            $response['messages'] = "La password non e corretta";
                        }
                    } else {
                        $response['status'] = "No User";
                        $response['messages'] = "Utente non trovato";
                    }
                    return $response;
                }
            )
        );
    }

}