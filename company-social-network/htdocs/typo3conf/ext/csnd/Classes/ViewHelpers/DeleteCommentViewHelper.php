<?php
namespace Wind\Csnd\ViewHelpers;
// questa stringa serveper definire che si tratta di un ViewHelper
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use Wind\Csnd\Utility\CompanySocialNetwork;
use Wind\Csnd\Domain\Model\User;
use Wind\Csnd\Domain\Model\Post;
use Wind\Csnd\Domain\Model\Comment;

class DeleteCommentViewHelper extends AbstractViewHelper
{

    /**
     * CompanySocialNetwork
     * 
     * @var \Wind\Csnd\Utility\CompanySocialNetwork
     * @inject
     */
    protected $csn = null;

    /** 
     * @param $post \Wind\Csnd\Domain\Model\Comment
     * @param $then string
     * @param $else string
     * @return string     * 
     */
    public function render(\Wind\Csnd\Domain\Model\Comment $post, $then, $else)
    {
        /** @var User $user  */
        $userUid = CompanySocialNetwork::readUserCookie();
        


            if ($userUid == $post->getUser()) {          
                return "il comennto è mio"; 
                         
            }

       return "--------------".$post->getUser()->getUid();
       // return $this->renderChildren();       
    }
}