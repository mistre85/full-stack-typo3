<?php

namespace Wind\Csnd\Rest;

use Cundd\Rest\Handler\HandlerInterface;
use Cundd\Rest\Http\RestRequestInterface;
use Cundd\Rest\Router\Route;
use Cundd\Rest\Router\RouterInterface;
use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
use Wind\Csnd\Domain\Model\Post;
use Wind\Csnd\Domain\Model\User;
use Wind\Csnd\Utility\CompanySocialNetwork;

/**
 * Example handler
 */
class PostHandler implements HandlerInterface
{
    /**
     * postRepository
     *
     * @var \Wind\Csnd\Domain\Repository\PostRepository
     * @inject
     */
    protected $postRepository = null;

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
     * @var \Wind\Csnd\Rest\UserResponse
     * @inject
     */
    private $response = null;

    /**
     * postRepository
     *
     * @var  \Wind\CompanySocialNetwork\View\PostStandaloneView
     * @inject
     */
    protected $likesStandalone = null;


    /**
     * postRepository
     *
     * @var  \Wind\CompanySocialNetwork\View\PostStandaloneView
     * @inject
     */
    protected $buttonStandalone = null;

    /**
     * @param RouterInterface $router
     * @param RestRequestInterface $request
     */
    public function configureRoutes(RouterInterface $router, RestRequestInterface $request)
    {

        $router->add(
            Route::post(
                $request->getResourceType() . "/like",
                function (RestRequestInterface $request) {


                    $data = $request->getSentData();
                    $postUid = $data['postUid'];

                    //utente che fa il mi piace (??) --> //todo: rivedere il modello di dominio
                    $user = $this->csn->getLoggedUser();

                    //assegnare il mi piace a quel post
                    /** @var Post $postToLike */
                    $postToLike = $this->postRepository->findByUid($postUid);

                    /** @var User $like */
                    $userFound = false;
                    foreach ($postToLike->getLikes() as $like) {
                        if ($like->getUid() == $user->getUid()) {
                            $userFound = true;
                            break;
                        }
                    }

                    if ($userFound) {
                        $postToLike->removeLike($user);
                    } else {
                        $postToLike->addLike($user);
                    }

                    $this->postRepository->update($postToLike);
                    $this->persistenceManager->persistAll();

                    //preparo risposta

                    $data = [
                        'postUid' => $postToLike->getUid(),
                        'likes' => $postToLike->getLikesCount(),
                    ];

                    //preparo tempalte

                    $this->likesStandalone->setLikesTextView();
                    $this->likesStandalone->assign('post', $postToLike);
                    $data['html']['likes'] = $this->likesStandalone->render();

                    $this->buttonStandalone->setLikeButtonView();
                    $this->buttonStandalone->assign('post', $postToLike);
                    $this->buttonStandalone->assign('variabileFluid', "prova");
                    $data['html']['button'] = $this->buttonStandalone->render();

                    $this->response->setStatus(Response::STATUS_OK);
                    $this->response->addData($data);

                    return $this->response->toArray();

                }
            )
        );

    }

}