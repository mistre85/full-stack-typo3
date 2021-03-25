<?php

namespace Wind\Csnd\Rest;

use Cundd\Rest\Handler\HandlerInterface;
use Cundd\Rest\Http\RestRequestInterface;
use Cundd\Rest\Router\Route;
use Cundd\Rest\Router\RouterInterface;
use TYPO3\CMS\Core\Database\DatabaseConnection;
use Wind\Csnd\Domain\Model\User;
use Wind\Csnd\Utility\CompanySocialNetwork;
use Wind\Csnd\Utility\Response;

/**
 * Example handler
 */
class UserHandler implements HandlerInterface
{
    /**
     * postRepository
     *
     * @var \Wind\Csnd\Domain\Repository\UserRepository
     * @inject
     */
    protected $userRepository = null;

    /**
     * @var \Wind\Csnd\Utility\CompanySocialNetwork
     * @inject
     */
    private $csn = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     * @inject
     */
    private $persistenceManager = null;


    /**
     * @var \Wind\Csnd\Utility\Response
     * @inject
     */
    private $response = null;

    /**
     * @var \TYPO3\CMS\Core\Database\DatabaseConnection
     */
    private $databaseConnection = null;

    public function __construct()
    {
        $this->databaseConnection = $GLOBALS['TYPO3_DB'];
    }

    /**
     * @param RouterInterface $router
     * @param RestRequestInterface $request
     */
    public function configureRoutes(RouterInterface $router, RestRequestInterface $request)
    {

        $router->add(
            Route::post(
                $request->getResourceType() . "/login",
                function (RestRequestInterface $request) {


                    $data = $request->getSentData();

                    /** @var User $user */
                    $user = $this->userRepository->findByUsername($data['username'])->current();

                    if ($user && $user->getPassword() == $data['password']) {
                        CompanySocialNetwork::registerUserCookie($user);
                        //return $user->getUid();
                        //arricchimento response

                        $this->response->setStatus(Response::STATUS_OK);
                        $this->response->addMessage("Accesso avvenuto correttamente.", true, "<br/>");
                        $this->response->addMessage("Redirect in 3 secondi.");
                    } else {
                        //return false;
                        //in caso di "errore"

                        $this->response->setStatus(Response::STATUS_KO);
                        $this->response->addMessage("Nome utente o password errati.", true, "<br/>");
                        $this->response->addMessage("Redirect in 3 secondi.");

                    }

                    return $this->response->toArray();

                }
            )
        );

        $router->add(
            Route::post(
                $request->getResourceType() . "/status/toggle",
                function (RestRequestInterface $request) {

                    /*
                     * rimuovo per non utilizzare la persistenza
                     */
                    //$user = $this->csn->getLoggedUser();
                    //$user->setOnline(!$user->getOnline());
                    //$this->userRepository->update($user);

                    //todo: fare una query diretta!
                    //$this->persistenceManager->persistAll();
                    $userId = CompanySocialNetwork::readUserCookie();

                    //recupero l'utente
                    $where = " uid = '$userId' ";
                    $user = $this->databaseConnection->exec_SELECTgetSingleRow('online', 'tx_csnd_domain_model_user', $where);
                    $this->databaseConnection->exec_UPDATEquery('tx_csnd_domain_model_user',
                        $where,
                        array('online' => !$user['online'])
                    );

                    $this->response->addData([
                        'online' => !$user['online']
                    ]);

                    $this->response->setStatus(Response::STATUS_OK);

                    return $this->response->toArray();
                }
            )
        );

        $router->add(
            Route::get(
                $request->getResourceType() . "/status/list",
                function (RestRequestInterface $request) {

                    $userList = $this->userRepository->findAll();

                    /** @var User $user */
                    foreach ($userList as $user) {
                        $this->response->addData(
                            [
                                'id' => $user->getUid(),
                                'online' => $user->getOnline()
                            ]);
                    }

                    $this->response->setMessage("");
                    $this->response->setStatus(Response::STATUS_OK);

                    return $this->response->toArray();
                }
            )
        );

    }

}