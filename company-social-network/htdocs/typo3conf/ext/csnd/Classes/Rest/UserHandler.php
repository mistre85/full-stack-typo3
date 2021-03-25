<?php

namespace Windtre\Csnd\Rest;

use Cundd\Rest\Handler\HandlerInterface;
use Cundd\Rest\Http\RestRequestInterface;
use Cundd\Rest\Router\RouterInterface;
use Cundd\Rest\Router\Route;
use TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface;
use Windtre\CompanySocialNetwork\Utility\CompanySocialNetwork;
use Windtre\Csnd\Domain\Model\User;
use Windtre\Csnd\Domain\Repository\UserRepository;
use Windtre\CompanySocialNetwork\Utility\ApiResponse;

/**
 * Class UserHandler
 * @package Windtre\Csnd\Rest
 */
class UserHandler implements HandlerInterface
{
    /**
     * @var \Windtre\Csnd\Domain\Repository\UserRepository
     * @inject
     */
    protected $userRepository = null;

    /**
     * @var \Windtre\CompanySocialNetwork\Utility\ApiResponse
     * @inject
     */
    protected $apiResponse = null;

    /**
     * @var \Windtre\CompanySocialNetwork\Utility\CompanySocialNetwork
     * @inject
     */
    protected $csn = null;

    /**
     * @var TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     * @inject
     */
    protected $persistenceManager = null;

    public function configureRoutes(RouterInterface $router, RestRequestInterface $request)
    {
        $router->add(
            Route::post(
                $request->getResourceType() . '/login',
                function( RestRequestInterface $request ) {

                    $data = $request->getSentData();

                    /** @var User $user */
                    $user = $this->userRepository->findByUsername($data['username'])->current();
                    if( $user->getPassword() == $data['password'] ) {
                        CompanySocialNetwork::registerCookie($user);
                        //return $user->getUid();
                        $this->apiResponse->setStatus('ok');
                        $this->apiResponse->setMessage('Login effettuato con successo');
                    } else {
                        $this->apiResponse->setStatus('ko');
                        $this->apiResponse->setMessage('Username e password non corretti');
                    }
                    return $this->apiResponse->sendResponse();
                }
            )
        );

        $router->add(
            Route::post(
                $request->getResourceType() . '/status',
                function( RestRequestInterface $request ) {
                    $status = $request->getSentData();
                    /** @var User $user */
                    $user = $this->csn->getLoggedUser();
                    $user->setOnline(!$user->isOnline());
                    $this->userRepository->update($user);

                    $this->persistenceManager->persistAll();

                    $this->apiResponse->setStatus('ok');
                    $this->apiResponse->setMessage('Status modificato da ' . $status['status']);
                    $this->apiResponse->setData(['status'=>$user->isOnline()]);

                    return $this->apiResponse->sendResponse();
                }
            )
        );


        $router->add(
            Route::get(
                $request->getResourceType() . '/userstatus',
                function( RestRequestInterface $request ) {
                    /** @var User $users */
                    $users = $this->userRepository->findAll();
                    /** @var User $user */
                    foreach( $users as $user ) {
                        $data[] = ['uid'=>$user->getUid(), 'status'=>$user->isOnline()];
                    }
                    $this->apiResponse->setStatus('ok');
                    $this->apiResponse->setData($data);
                    return $this->apiResponse->sendResponse();
                }
            )
        );
    }
}