<?php

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
	
	public function tagAction($tag) {
		$videoIds = Tag::find("tag = '{$tag}'");
		$videos = array();
		foreach ($videoIds as $videoId) {
			$videos[] = Video::findFirst($videoId->id_video);
		}
		$this->view->tag = $tag;
		$this->view->videos = $videos;
	}
	
	public function viewAction($id) {
		$this->view->video = Video::findFirst($id);
		\Phalcon\Tag::setTitle($this->view->video->name);
		\Phalcon\Tag::appendTitle($this->appendTitle);
	}
}