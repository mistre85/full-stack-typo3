<?php

namespace Wind\Csnd\Rest;

use Cundd\Rest\Handler\HandlerInterface;
use Cundd\Rest\Http\RestRequestInterface;
use Cundd\Rest\Router\Route;
use Cundd\Rest\Router\RouterInterface;

class ContentHandler implements HandlerInterface
{
    /**
     * @var \Wind\CompanySocialNetwork\View\UserStatusStandaloneView
     * @inject
     */
    private $userStatusView = null;

    /**
     * CompanySocialNetwork
     *
     * @var \Wind\Csnd\Utility\CompanySocialNetwork
     * @inject
     */
    protected $csn = null;

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
    }
}