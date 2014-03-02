<?php

namespace Shagtv\Frontend\Controllers;

use Shagtv\Frontend\Models\Video;

class IndexController extends ControllerBase {

	public function initialize()
    {
        $this->view->setTemplateAfter('main');
        \Phalcon\Tag::setTitle('Администрирование');
        parent::initialize();
    }

	public function indexAction() {
		$this->view->videos = Video::find();
	}
}
