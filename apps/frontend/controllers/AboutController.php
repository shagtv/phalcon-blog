<?php

namespace Shagtv\Frontend\Controllers;

class AboutController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateAfter('main');
        \Phalcon\Tag::setTitle('Информация об авторе');
        parent::initialize();
    }

    public function indexAction()
    {
    }
}
