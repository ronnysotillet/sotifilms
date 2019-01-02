<?php

class IndexController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Bienvenido');
        parent::initialize();
    }

    public function indexAction()
    {

    }
}
