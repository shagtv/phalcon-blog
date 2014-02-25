<?php

namespace Shagtv\Backend\Controllers;

use Shagtv\Backend\Models\Video;

class VideoController extends ControllerBase {

	public function initialize()
    {
        $this->view->setTemplateAfter('main');
        \Phalcon\Tag::setTitle('Редактирование видео');
        parent::initialize();
    }

	public function indexAction() {
		$this->view->videos = Video::find();
	}
	
	public function editAction($id) {
		if ($this->request->isPost()) {
            
        }
		$this->view->video = Video::findFirst(compact('id'));
		if (!$this->view->video) {
			$this->flash->error('Видео не найдено');
		}
	}
	
	public function deleteAction() {
		
	}
}
