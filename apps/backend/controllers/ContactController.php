<?php

namespace Shagtv\Backend\Controllers;

class ContactController extends ControllerBase {

	public function initialize()
    {
        $this->view->setTemplateAfter('main');
        \Phalcon\Tag::setTitle('Редактирование контактов');
        parent::initialize();
    }

	public function indexAction() {
	}
}
