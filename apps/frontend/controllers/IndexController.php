<?php

namespace Shagtv\Frontend\Controllers;

use Shagtv\Frontend\Models\Video;

class IndexController extends ControllerBase {

	public function initialize()
    {
        $this->view->setTemplateAfter('main');
        \Phalcon\Tag::setTitle('Видео о программировании');
        parent::initialize();
    }

	public function indexAction() {
		$this->view->videos = Video::find();
	}
	
	public function viewAction($id) {
		$this->view->video = Video::findFirst($id);
		\Phalcon\Tag::setTitle($this->view->video->name);
		\Phalcon\Tag::appendTitle($this->appendTitle);
	}
}
