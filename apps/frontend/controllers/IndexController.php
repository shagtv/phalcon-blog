<?php

namespace Shagtv\Frontend\Controllers;

class IndexController extends ControllerBase {

	public function initialize()
    {
        $this->view->setTemplateAfter('main');
        \Phalcon\Tag::setTitle('Администрирование');
        parent::initialize();
    }

	public function indexAction() {
	}
}
