<?php
namespace Wind\Csnd\ViewHelpers;
// questa stringa serveper definire che si tratta di un ViewHelper
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use Wind\Csnd\Utility\CompanySocialNetwork;
use Wind\Csnd\Domain\Model\User;
use Wind\Csnd\Domain\Model\Post;

class LikeButtonTextViewHelper extends AbstractViewHelper
{

    /**
     * CompanySocialNetwork
     * 
     * @var \Wind\Csnd\Utility\CompanySocialNetwork
     * @inject
     */
    protected $csn = null;

    /** 
     * @param $post \Wind\Csnd\Domain\Model\Post
     * @param $then string
     * @param $else string
     * @return string     * 
     */
    public function render(\Wind\Csnd\Domain\Model\Post $post, $then, $else)
    {
        /** @var User $user  */
        // $user = $this->csn->getLoggedUser();
        // var_dump($user);
        $userUid = CompanySocialNetwork::readUserCookie();

        foreach($post->getLikes() as $like ){
            if ($userUid == $like->getUid()) {
                return $then;                    
            }
        }
        return $else;
        
    }

}