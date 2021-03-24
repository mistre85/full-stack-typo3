<?php

namespace Wind\Csnd\View\Post;

class ListJson extends \TYPO3\CMS\Extbase\Mvc\View\AbstractView
{

    public function render()
    {

        return json_encode(array('id' => 1, 'text' => 'buongiorno'));
    }
}