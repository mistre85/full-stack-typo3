<?php

namespace Wind\Csnd\Rest;

use Cundd\Rest\Handler\HandlerInterface;
use Cundd\Rest\Http\RestRequestInterface;
use Cundd\Rest\Router\Route;
use Cundd\Rest\Router\RouterInterface;
use Wind\Csnd\Utility\Response;
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
     * postRepository
     *
     * @var \Wind\Csnd\Domain\Repository\CommentRepository
     * @inject
     */
    protected $commentRepository = null;

    /**
     * @var \Wind\CompanySocialNetwork\View\UserStatusStandaloneView
     * @inject
     */
    private $userStatusView = null;

    /**
     * @var \Wind\CompanySocialNetwork\View\PostStandaloneView
     * @inject
     */
    private $postStandaloneView = null;

    /**
     * @var \Wind\CompanySocialNetwork\View\PostStandaloneView
     * @inject
     */
    private $likeStandalone = null;

    /**
     * @var \Wind\CompanySocialNetwork\View\PostStandaloneView
     * @inject
     */
    private $buttonStandalone = null;

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
                        postStandaloeView è la nuova view che ho dovuto creare per poter gestire l'inserimento/append dei commenti
                    */
                    $this->postStandaloneView->setPostComment();
                    $this->postStandaloneView->assign('comment', $newComment);


                    $this->postStandaloneView->assign('user', $loggedUser);

                    return $this->postStandaloneView->render();
                }
            )
        );

        $router->add(
            Route::post(
                $request->getResourceType() . "/comment/remove",
                function (RestRequestInterface $request) {
                    /* Creo una nuova istanza di response (Aggiunto in testa use Wind\Csnd\Utility\Response;) */
                    $response = new Response();

                    /* Recupero i dati della chiamata e li metto in due variabili (i dati li recupero dalla chiamata presente in cnsd.js che intercetta il click sul button */
                    $data = $request->getSentData();
                    $userUid = $data['userUid'];
                    $commentUid = $data['commentUid'];

                    /** @var User $loggedUser */
                    /* Sfruttando l'utility csn sfrutto la funzione getLoggedUser() per farmi dare l'utrente loggato  */
                    $loggedUser = $this->csn->getLoggedUser();
                    /*
                         Se l'utente loggato è nullo o lauid dell'utente che ha scritto il post è diversa dalla uid dell'utente loggato
                         allora comilo la response per l'errore
                     */
                    if (empty($loggedUser) || $loggedUser->getUid() != $userUid) {
                        $response->setStatus(Response::STAUS_KO);
                        $response->setMessage("Utente non abilitato all'azione");
                        return $response->toArray();
                    }

                    /** @var Comment $comment */
                    /* Recupero il commento tramite l'uid */
                    $comment = $this->commentRepository->findByUid($commentUid);
                    /* Se il commento è vuoto, quindi non è stato trovato allora compilo la response per l'errore */
                    if (empty($comment)) {
                        $response->setStatus(Response::STAUS_KO);
                        $response->setMessage("Post non trovato");
                        return $response->toArray();
                    }
                    /* Se il commento è stato trovato, ne faccio la remove e quindi richiamo persistAll */
                    $this->commentRepository->remove($comment);
                    $this->persistenceManager->persistAll();
                    /* Compilo la response per l'attività completata */
                    $response->setStatus(Response::STAUS_OK);
                    $response->setMessage("Post cancellato");

                    $response->addData(['commentUid' => $commentUid]);
                    return $response->toArray();
                }
            )
        );

        $router->add(
            Route::post(
                $request->getResourceType() . '/comment/like',
                function (RestRequestInterface $request) {
                    /* Creo una nuova istanza di Response */
                    $response = new Response();

                    /* Recupero i dati passati in post dalla chiamata Ajax e valorizzo la variabile del postUid*/
                    $data = $request->getSentData();
                    $postUid = $data['postUid'];

                    /* Recupero del info dell'utente tramite l'utility csn */
                    $user = $this->csn->getLoggedUser();
                    /* recupero l'oggetto post tramite l'Uid che mi sono passato */
                    $postToLike = $this->postRepository->findByUid($postUid);

                    /** @var User $like */
                    /** @var Post $postToLike */
                    /* ciclo su $postLike, di ogli like verifico se l'utente corrisponde all'utente loggato */
                    $userFound = false;
                    foreach ($postToLike->getLikes() as $like) {
                        if ($like->getUid() == $user->getUid()) {
                            $userFound = true;
                            break;
                        }
                    }
                    /* Se trovo l'utente vuol dire che questo ha già messo un like, quindi lo rimuovo, altrimenti lo aggiungo */
                    if ($userFound) {
                        $postToLike->removeLike($user);
                    } else {
                        $postToLike->addLike($user);
                    }
                    /* Eseguo l'update e faccio la persistenza */
                    $this->postRepository->update($postToLike);
                    $this->persistenceManager->persistAll();
                    /* popolo l'array data */
                    $data = [
                        'postUid' => $postToLike->getUid(),
                        'likes' => $postToLike->getLikesCount()
                    ];

                    /* Preparazione Template per i numero di like e per il bottone*/
                    $this->likeStandalone->setLikeTextView();
                    $this->likeStandalone->assign('post', $postToLike);
                    $data['html']['likes'] = $this->likeStandalone->render();

                    $this->buttonStandalone->setLikeButtonView();
                    $this->buttonStandalone->assign('post', $postToLike);
                    $data['html']['button'] = $this->buttonStandalone->render();

                    /* completo la response e quindi ritorno la conversione in array */
                    $response->setStatus(Response::STAUS_OK);
                    $response->setMessage("funzione Like correttamente terminata");
                    $response->addData($data);
                    return $response->toArray();

                }

            )
        );
    }


}