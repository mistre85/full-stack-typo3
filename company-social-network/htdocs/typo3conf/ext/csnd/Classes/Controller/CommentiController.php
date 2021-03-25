<?php
namespace Windtre\Csnd\Controller;

use Windtre\Csnd\Domain\Model\Post;
use Windtre\Csnd\Domain\Repository\PostRepository;

/***
 *
 * This file is part of the "Company Social Network Data" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2021 
 *
 ***/

/**
 * CommentiController
 */
class CommentiController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * commentiRepository
     * 
     * @var \Windtre\Csnd\Domain\Repository\CommentiRepository
     * @inject
     */
    protected $commentiRepository = null;

    /**
     * @var \Windtre\Csnd\Domain\Repository\PostRepository
     * @inject
     */
    protected $postRepository = null;

    /**
     * @var \Windtre\CompanySocialNetwork\Utility\CompanySocialNetwork
     * @inject
     */
    protected $csn = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $commentis = $this->commentiRepository->findAll();
        $this->view->assign('commentis', $commentis);
    }

    /**
     * action show
     * 
     * @param \Windtre\Csnd\Domain\Model\Commenti $commenti
     * @return void
     */
    public function showAction(\Windtre\Csnd\Domain\Model\Commenti $commenti)
    {
        $this->view->assign('commenti', $commenti);
    }

    /**
     * action new
     * 
     * @return void
     */
    public function newAction()
    {

    }

    /**
     * action create
     * 
     * @param \Windtre\Csnd\Domain\Model\Commenti $newCommenti
     * @return void
     */
    public function createAction(\Windtre\Csnd\Domain\Model\Commenti $newCommenti)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->commentiRepository->add($newCommenti);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \Windtre\Csnd\Domain\Model\Commenti $commenti
     * @ignorevalidation $commenti
     * @return void
     */
    public function editAction(\Windtre\Csnd\Domain\Model\Commenti $commenti)
    {
        $this->view->assign('commenti', $commenti);
    }

    /**
     * action update
     * 
     * @param \Windtre\Csnd\Domain\Model\Commenti $commenti
     * @return void
     */
    public function updateAction(\Windtre\Csnd\Domain\Model\Commenti $commenti)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->commentiRepository->update($commenti);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \Windtre\Csnd\Domain\Model\Commenti $commenti
     * @return void
     */
    public function deleteAction(\Windtre\Csnd\Domain\Model\Commenti $commenti)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->commentiRepository->remove($commenti);
        $this->redirect('list');
    }

    /**
     * action create
     *
     * @param \Windtre\Csnd\Domain\Model\Commenti $newCommenti
     * @param int $postuid
     * @return void
     */
    public function savecommentAction(\Windtre\Csnd\Domain\Model\Commenti $newCommenti, $postuid)
    {
        /** @var CompanySocialNetwork $user */
        $user = $this->csn->getLoggedUser();
        $newCommenti->setUser($user);

        /** @var Post $post */
        $post = $this->postRepository->findByUid($postuid);
        $post->addCommenti($newCommenti);
        $this->postRepository->update($post);

        $this->redirectToUri('area-personale/bacheca');
    }
}
