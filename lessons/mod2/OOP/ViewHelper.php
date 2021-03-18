<?php


abstract class AbstractViewHelper
{

    private $contenuto; // ??

    public function setContent($contenuto)
    {

        //ragionamenti ??
        $contenuto = $this->contenuto;
    }

    //abstract public function render();
}

class H1ViewHelper extends AbstractViewHelper
{


    public function render($page)
    {

        return "<h1>" . $this->titolo . "</h1>";
    }
}

class PViewHelper extends AbstractViewHelper
{


    public function render()
    {

        return "<p>" . $this->paragrafo . "</p>";
    }
}

class TagViewhelper extends AbstractViewHelper
{

    public function render()
    {
        return "<$this->tag>" . $this->contenuto . "<$this->tag/>";
    }
}


$pargrafo = new PViewHelper();

$pargrafo->render();

