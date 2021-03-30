<?php

namespace Wind\Csnd\Rest;

use Cundd\Rest\Handler\HandlerInterface;
use Cundd\Rest\Http\RestRequestInterface;
use Cundd\Rest\Router\Route;
use Cundd\Rest\Router\RouterInterface;
use http\Env\Response;
use Wind\Csnd\Domain\Model\Comment;
use Wind\Csnd\Domain\Model\User;
use Wind\Csnd\Domain\Model\Post;

class ContentHandler implements HandlerInterface
{
    /**
     * postRepository
     *
     * @var \Wind\Csnd\Domain\Repository\PostRepository
     * @inject
     */
    protected $postRepository = null;

    /**
     * @var \Wind\CompanySocialNetwork\View\UserStatusStandaloneView
     * @inject
     */
    private $userStatusView = null;

    /**
     * @var \Wind\CompanySocialNetwork\View\PostCommentStandaloneView
     * @inject
     */
    private  $postCommentStandaloeView = null;

    /**
     * CompanySocialNetwork
     *
     * @var \Wind\Csnd\Utility\CompanySocialNetwork
     * @inject
     */
    protected $csn = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     * @inject
     *
     */
    private $persistenceManager = null;


    /**
     * @param RouterInterface $router
     * @param RestRequestInterface $request
     */
    public function configureRoutes(RouterInterface $router, RestRequestInterface $request)
    {
        $router->add(
            Route::get(
                $request->getResourceType() . "/status",
                function (RestRequestInterface $request) {
                    $user = $this->csn->getLoggedUser();
                    $this->userStatusView->assign('user', $user);
                    return $this->userStatusView->render();
                }
            )
        );

        $router->add(
            Route::post(
                $request->getResourceType() . "/post/add",
                function (RestRequestInterface $request) {
                    /* recupero i dati del Form e li metto in due variabili */
                    $data = $request->getSentData();
                    $postUid = $data['postUid'];
                    $postText = $data['postText'];

                    /** @var Post $post */
                    /* Recupero l'oggetto post tramite il suo UID (Devo fare l'inject della classe Repository) */
                    $post = $this->postRepository->findByUid($postUid);

                    /** @var User $loggedUser */
                    /* Recupero l'utente loggato tramite quantogia fatto in "csn" (Devo fare l'inject di CompanySocialNetwork) */
                    $loggedUser = $this->csn->getLoggedUser();

                    /* creo una nuova istanza dell'oggetto Comment e vado a settare Test e User */
                    $newComment = new Comment();
                    $newComment->setText($postText);
                    $newComment->setUser($loggedUser);

                    /* per poter accedere alla funzionalita addComment ho dovuto fare "use Wind\Csnd\Domain\Model\Post;" */
                    $post->addComment($newComment);
                    /*
                        Faccio l'update dellpost e quindi richiamo la peristAll perchè altrimenti la scrittura non avverebbe avuto effetto
                        (Ho dovuto fare l'inject di \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager)
                    */
                    $this->persistenceManager->update($post);
                    $this->persistenceManager->persistAll();

                    /*
                        Assegno alla variabile comment il contenuto di $newComment
                        postCommentStandaloeView è la nuova view che ho dovuto creare per poter gestire l'inserimento/append dei commenti
                    */
                    $this->postCommentStandaloeView->assign('comment', $newComment);
                    $this->postCommentStandaloeView->assign('user', $loggedUser);

                    return $this->postCommentStandaloeView->render();
                }
            )
        );

        $router->add(
            Route::post(
                $request->getResourceType() . "/comment/remove",
                function (RestRequestInterface $request) {
                    $response = new Response();

                    /* Recupero i dati della chiamata e li metto in due variabili */
                    $data = $request->getSentData();use
                    $userUid = $data['userUid'];
                    $commentUid = $data['commentUid'];

                    /** @var User %loggedUser */
                    $loggedUser = $this->csn->getLoggedUser();

                    if(empty($loggedUser) || $loggedUser != $userUid){
                        $response->setStatus(Response::)
                    }




                }
            )
        )
    }


}