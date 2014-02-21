<?php

namespace Shagtv\Backend\Controllers;

class IndexController extends ControllerBase {

	public function initialize()
    {
        $this->view->setTemplateAfter('main');
        \Phalcon\Tag::setTitle('Блог для программистов');
        parent::initialize();
    }

	public function indexAction() {
	}
}
