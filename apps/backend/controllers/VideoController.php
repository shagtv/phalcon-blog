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
		$this->view->video = Video::findFirst($id);
		if (!$this->view->video) {
			$this->flash->error('Видео не найдено');
		}
		if ($this->request->isPost()) {
			$this->view->video->name = trim($_POST['name']);
			$this->view->video->code = trim($_POST['code']);
			$this->view->video->descr = trim($_POST['descr']);
			$result = $this->view->video->save();
			if (!$result) {
				echo "save error";
			}
        }
	}
	
	public function newAction() {
		if ($this->request->isPost()) {
			$this->view->video = new Video();
			$this->view->video->name = trim($_POST['name']);
			$this->view->video->code = trim($_POST['code']);
			$this->view->video->descr = trim($_POST['descr']);
			$result = $this->view->video->create();
			if ($result) {
				return $this->redirect('backend/video/edit/'.$this->view->video->id);
			}
			echo "save error";
        }
	}
	
	public function deleteAction($id) {
		$this->view->video = Video::findFirst($id);
		if (!$this->view->video) {
			$this->flash->error('Видео не найдено');
		}
		$result = $this->view->video->delete();
		if ($result) {
			return $this->redirect('backend/video/index');
		}
		echo "delete error";
	}
}
