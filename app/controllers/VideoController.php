<?php

class VideoController extends ControllerBase {

	public $videoPerPage = 10;
	
	public function initialize()
    {
        $this->view->setTemplateAfter('main');
        \Phalcon\Tag::setTitle('Видео о программировании');
        parent::initialize();
    }

	public function listAction() {
		$videos = Videos::find();
		$this->view->page = $this->deployPaginator($videos);
	}
	
	public function tagAction($tag) {
		$videos = Videos::find([['tags' => $tag]]);
		$this->view->page = $this->deployPaginator($videos);
		$this->view->tag = $tag;
	}
	
	public function showAction($id) {
		$this->view->video = Videos::findFirst([['name' => $id]]);
		\Phalcon\Tag::setTitle($this->view->video->name);
		\Phalcon\Tag::appendTitle($this->appendTitle);
	}
	
	protected function deployPaginator($data) {
		$currentPage = !empty($_GET["page"]) ? (int)$_GET["page"] : 1;
		$paginator = new \Phalcon\Paginator\Adapter\NativeArray(
				[
					"data" => $data,
					"limit" => $this->videoPerPage,
					"page" => $currentPage
				]
		);

		return $paginator->getPaginate();
	}
}