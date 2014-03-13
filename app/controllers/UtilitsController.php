<?php

class UtilitsController extends ControllerBase {

	public function initialize()
    {
        $this->view->setTemplateAfter('main');
        \Phalcon\Tag::setTitle('Онлайн сервисы');
        parent::initialize();
    }

	public function indexAction() {
	}
}