<?php
namespace Wind\Csnd\Rest;
use Cundd\Rest\Handler\HandlerInterface;
use Cundd\Rest\Http\RestRequestInterface;
use Cundd\Rest\Router\RouterInterface;
use Cundd\Rest\Router\Route;
// use dei Model
use Wind\Csnd\Domain\Model\Comment;
use Wind\Csnd\Domain\Model\Post;
use Wind\Csnd\Domain\Model\User;

use Wind\Csnd\Utility\Response;


/**
 * Example handler
 */
class PostHandler implements HandlerInterface
{
    /**
     * @var \Wind\CompanySocialNetwork\View\UserStatusStandaloneView
     * @inject
     */
    private $userStatusView = null;

    /**
     * @var \Wind\CompanySocialNetwork\View\PostStandaloneView
     * @inject
     */
    private $likesStandAloneView = null;

     /**
     * @var \Wind\CompanySocialNetwork\View\PostStandaloneView
     * @inject
     */
    private $buttonStandAloneView = null;

     /**
     * CompanySocialNetwork
     *
     * @var \Wind\Csnd\Utility\CompanySocialNetwork
     * @inject
     */
    protected $csn = null;

    /**
     * userRepository
     *
     * @var \Wind\Csnd\Domain\Repository\UserRepository
     * @inject
     */
    protected $userRepository = null;

    /**
     * postRepository
     *
     * @var \Wind\Csnd\Domain\Repository\PostRepository
     * @inject
     */
    protected $postRepository = null;

    /**
     * commentRepository
     *
     * @var \Wind\Csnd\Domain\Repository\CommentRepository
     * @inject
     */
    protected $commentRepository = null;

    /**
     * @param RouterInterface $router
     * @param RestRequestInterface $request
     */

    /**
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     * @inject
     */
    protected $persistenceManager = null; 

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
                $request->getResourceType() . '/like',
                function (RestRequestInterface $request) {
                    
                    // recupero i dati dal form o dal front end
                    $data = $request->getSentData();
                    $postUid = $data['postUid'];

                    // utente che fa l'azione del mi piace ricavato dal getLoggedUser che legge il cookie
                    $loggerUser = $this->csn->getLoggedUser();

                    // Devo assegnare quel "mi Piace" al post
                    /** @var Post $postToLike  */
                    $postToLike = $this->postRepository->findByUid($postUid);
                   
                    /** @var User $like  */
                    $userfound=false;
                    foreach($postToLike->getLikes() as $like ){
                        // likes è un array che si trova all'interno di Post
                        // likes --> ha tutte le proprietà/oggetti di User
                        if ($like->getUid() == $loggerUser->getUid() ) {
                            $userfound=true; 
                            break;          
                        }
                    }

                    // PREPARAZIONE DEL MODEL 
                    if ($userfound){
                        //utente che ha già fatto il mi piace e che vuole cambiare a "non mi piace"
                        $postToLike->removeLike($loggerUser);
                    } else {
                        $postToLike->addLike($loggerUser);
                    }
                    
                    // AGGIORNAMENTO/MODIFICHE SU DATABASE
                    $this->postRepository->update($postToLike);
                    $this->persistenceManager->persistAll();

                    // preparo la risposta
                    $data = [
                        'postUid' => $postToLike->getUid(),  
                        // 'likes' => $postToLike->getLikesCount(),
                    ];

                    //preparo il template
                 
                    $this->likesStandAloneView->setLikesTextView();
                       
                    $this->likesStandAloneView->assign('item', $postToLike);
                    
                    $data['html']['likes'] = $this->likesStandAloneView->render();
                    
                    $this->buttonStandAloneView->setLikeButtonView();
                    $this->buttonStandAloneView->assign('item', $postToLike);
                    $data['html']['button'] = $this->buttonStandAloneView->render();
                    
                    $this->response->setStatus(Response::STATUS_OK);
                    $this->response->addData($data);

                    return $this->response->toArray();
                    
                    

                }
            )
        );
    }
}