<?php

namespace Wind\Csnd\Rest;

use Cundd\Rest\Handler\HandlerInterface;
use Cundd\Rest\Router\Route;
use Cundd\Rest\Http\RestRequestInterface;
use Cundd\Rest\Router\RouterInterface;

use Wind\Csnd\Domain\Model\User;
use Wind\Csnd\Utility\CompanySocialNetwork;

use Wind\Csnd\Utility\Response;
use Wind\Csnd\Utility\ResponseMia;




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
     * Let the handler configure the routes
     *
     * @param RouterInterface      $router
     * @param RestRequestInterface $request
     */
    
     /**
     * CompanySocialNetwork
     *
     * @var \Wind\Csnd\Utility\CompanySocialNetwork
     * @inject
     */
    protected $csn = null;

    /**
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     * @inject
     */
    protected $persistenceManager = null; 
    /**
     * Response
     *
     * @var \Wind\Csnd\Utility\ResponseMia
     * @inject
     */
    protected $resp = null;

    /**
     * Response
     *
     * @var \Wind\Csnd\Utility\Response
     * @inject
     */
    protected $response = null;


    public function configureRoutes(RouterInterface $router, RestRequestInterface $request)
    {
    
        $router->add(
            Route::post(
                $request->getResourceType() . '/login',
                function (RestRequestInterface $request) {
                    
                   // restitusce solo i dati passati dal form o dal front end
                    $data = $request->getSentData();


                    /** @var User $user */
                    $user = $this->userRepository->findByUsername($data['username'])->current();
                    
                    if (!$user) {
                       
                       $this->resp->ResponseObj('status','ok');
                       $this->resp->ResponseObj('message','Utente non registrato!');

                        //$response['status']='ko';
                        //$response['message']='Utente non registrato!';
                    }    
                    else if( ($user->getPassword() != $data['password']) && ($user->getUsername() == $data['username']) ){
                        //$response['status']='ko';
                        //$response['message']='Password non corretta per la user inserita!';

                        $this->resp->ResponseObj('status','ko');
                        $this->resp->ResponseObj('message','CLASS: Password non corretta per la user inserita!');
                    }
                    else if( ($user->getPassword() == $data['password']) && ($user->getUsername() == $data['username']) ){
                        //$response['status']='ok';
                        //$response['message']='Utente registrato';

                        $this->resp->ResponseObj('status','ok');
                        $this->resp->ResponseObj('message','CLASS: Utente registrato');

                        CompanySocialNetwork::registerUserCookie($user);                        
                    }
                    
                    return $this->resp->viewResp();                    
                }
            )
        );


        $router->add(
            Route::post(
                $request->getResourceType() . '/status/toggle',
                function (RestRequestInterface $request) {
                    $user = $this->csn->getLoggedUser();
                   
                    $user->setOnline(!$user->getOnline());
                    $this->userRepository->update($user);

                    $this->persistenceManager->persistAll(); 

                    $this->response->addData([
                        //'id' => $user->getUid(),
                        'online' => $user->getOnline()
                    ]);
                    
                    $this->response->setStatus(Response::STATUS_OK);
                    return $this->response->toArray();

                }
            )
        );

        $router->add(
            Route::get(
                $request->getResourceType() . '/status/updateListStatus',
                function (RestRequestInterface $request) {
                    
                    
                    $users = $this->userRepository->findAll();
                    /** @var User $user */
                    foreach ($users as $user){                        
                        
                        $this->response->addData([
                            'username' => $user->getUsername(),
                            'online'   => $user->getOnline(),
                            'uid'      => $user->getUid()
                        ]);
                    } 
                    
                    return $this->response->toArray();

                }
            )
        );


    }
}