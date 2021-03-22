<?php

namespace Wind\Csnd\View\Post;

class ListJson extends \TYPO3\CMS\Extbase\Mvc\View\AbstractView
{

    public function render()
    {

        $postList = $this->variables['post'];
        return json_encode($postList);
    }
}