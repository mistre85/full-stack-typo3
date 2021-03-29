<?php
namespace Wind\Csnd\Rest;
use Cundd\Rest\Handler\HandlerInterface;
use Cundd\Rest\Http\RestRequestInterface;
use Cundd\Rest\Router\RouterInterface;
use Cundd\Rest\Router\Route;


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
                $request->getResourceType() . '/user/status', 
                function (RestRequestInterface $request) {
                    
                    $user = $this->csn->getLoggedUser();
                    $this->userStatusView->assign('user', $user);

                    //return "sono passato dalla chiamata GET Ajax";
                    return $this->userStatusView->render();

                }
            )
        );
    }
}