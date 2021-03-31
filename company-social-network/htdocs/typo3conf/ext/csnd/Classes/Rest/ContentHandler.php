<?php

namespace Wind\Csnd\Rest;

use Cundd\Rest\Handler\HandlerInterface;
use Cundd\Rest\Http\RestRequestInterface;
use Cundd\Rest\Router\Route;
use Cundd\Rest\Router\RouterInterface;
use Wind\Csnd\Domain\Model\Comment;
use Wind\Csnd\Domain\Model\Post;
use Wind\Csnd\Domain\Model\User;


/**
 * Example handler
 */
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
     * @var \Wind\CompanySocialNetwork\View\PostCommentStandaloneView
     * @inject
     */
    private $postCommentStandaloneView = null;

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
                $request->getResourceType() . "/user/status",
                function (RestRequestInterface $request) {

                    $user = $this->csn->getLoggedUser();
                    $this->userStatusView->assign('user', $user);

                    return $this->userStatusView->render();

                })
        );

        $router->add(
            Route::post(
                $request->getResourceType() . "/comment/add",
                function (RestRequestInterface $request) {

                    //recupero i dati del form
                    $data = $request->getSentData();

                    $postUid = $data['postUid'];
                    $postText = $data['postText'];

                    //todo: controlli?

                    //creo model / record per il db
                    /** @var Post $post */
                    $post = $this->postRepository->findByUid($postUid);

                    /** @var User $loggedUser */
                    $loggedUser = $this->csn->getLoggedUser();

                    //nei plugin questo passaggio sono automatici
                    //compilati dalla coppia form|link.action + param della action del controller di riferimento
                    $newComment = new Comment();
                    $newComment->setText($postText);

                    $newComment->setUser($loggedUser);

                    $post->addComment($newComment);

                    $this->postRepository->update($post);

                    $this->persistenceManager->persistAll();
                    //fine db / persistenza

                    $this->postCommentStandaloneView->assign('comment', $newComment);
                    $this->postCommentStandaloneView->assign('user', $loggedUser);

                    return $this->postCommentStandaloneView->render();

                })
        );

        $router->add(
            Route::post(
                $request->getResourceType() . "/comment/remove",
                function (RestRequestInterface $request) {

                    $response = new Response();

                    //recupero i dati del form
                    $data = $request->getSentData();

                    $userUid = $data['userUid'];
                    $commentUid = $data['commentUid'];

                    /** @var User $loggedUser */
                    $loggedUser = $this->csn->getLoggedUser();

                    if (empty($loggedUser) || $loggedUser->getUid() != $userUid) {
                        $response->setStatus(Response::STATUS_KO);
                        $response->setMessage("User not able to perform this action");
                        return $response->toArray();
                    }

                    /** @var Comment $comment */
                    $comment = $this->commentRepository->findByUid($commentUid);

                    if (empty($comment)) {
                        $response->setStatus(Response::STATUS_KO);
                        $response->setMessage("Comment not found");
                        return $response->toArray();
                    }

                    $this->commentRepository->remove($comment);
                    $this->persistenceManager->persistAll();
                    //fine db / persistenza

                    $response->setStatus(Response::STATUS_OK);
                    $response->setMessage("Post deleted");

                    $response->addData(['commentUid' => $commentUid]);

                    return $response->toArray();

                })
        );

    }

}
