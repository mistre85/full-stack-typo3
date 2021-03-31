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


/**
 * Example handler
 */
class ContentHandler implements HandlerInterface
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
    private $postCommentStandAloneView = null;

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
    
    public function configureRoutes(RouterInterface $router, RestRequestInterface $request)
    {
        $router->add(
            Route::get(
                $request->getResourceType() . '/user/status', 
                function (RestRequestInterface $request) {
                    
                    $user = $this->csn->getLoggedUser();
                    $this->userStatusView->assign('user', $user);

                    //return "sono passato dalla chiamata GET Ajax";
                    return $this->userStatusView->render();

                }
            )
        );

        $router->add(
            Route::post(
                $request->getResourceType() . '/post/add',
                function (RestRequestInterface $request) {
                    
                    // recupero i dati dal form o dal front end
                    $data = $request->getSentData();

                    $postUid = $data['postUid'];
                    $postText = $data['postText'];
                    
                    // todo controllo?
                    
                    // creo Model /Record per il DB
                    /** @var Post $post  */
                    $post = $this->postRepository->findByUid($postUid);

                    /** @var User $loggerUser  */
                    $loggerUser = $this->csn->getLoggedUser();
                   
                    // nei plugin questo passaggio avviene automaticamente
                    // compilati dalla coppia form|link.ction + param della action del Controller di riferimento
                    $newComment = new Comment();
                    $newComment->setText($postText);
                    $newComment->setUser($loggerUser);

                    $post->addComment($newComment);
                     
                    $this->postRepository->update($post);

                    $this->persistenceManager->persistAll();
                    // fine DB persistenza
                    
                    $this->postCommentStandAloneView->assign('comment', $newComment);
                    
                    return $this->postCommentStandAloneView->render();

                }
            )
        );

        $router->add(
            Route::post(
                $request->getResourceType() . '/comment/delete',
                function (RestRequestInterface $request) {
                    
                    // recupero i dati dal form o dal front end
                    $data = $request->getSentData();
                    $commentUid = $data['commentUid'];

                    // creo Model /Record per il DB
                    /** @var Comment $comment  */
                    $comment = $this->commentRepository->findByUid($commentUid);

                    /** @var User $loggerUser  */
                    $loggerUser = $this->csn->getLoggedUser();                   
                    // nei plugin questo passaggio avviene automaticamente
                    // compilati dalla coppia form|link.ction + param della action del Controller di riferimento
                    $this->commentRepository->remove($comment);

                    $this->persistenceManager->persistAll();
                    // fine DB persistenza
                    $response = ['esito' =>'ok',  'idCommento' => $commentUid ];
                    return $response;

                }
            )
        );
    }
}