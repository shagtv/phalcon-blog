<?php

class IndexController extends ControllerBase {

	public function initialize()
    {
        $this->view->setTemplateAfter('main');
        \Phalcon\Tag::setTitle('Видео о программировании');
        parent::initialize();
    }

	public function indexAction() {
		$this->forward('video/list');
	}
}