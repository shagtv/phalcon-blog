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
		$videos = Video::find();

		$this->view->page = $this->deployPaginator($videos);
	}
	
	public function tagAction($tag) {
		$videos = Video::query()
		->join('Tag', 'Video.id = Tag.id_video')	
		->where("Tag.tag = :tag:")
		->bind(array("tag" => $tag))
		->execute();
		
		$this->view->page = $this->deployPaginator($videos);
		$this->view->tag = $tag;
	}
	
	public function showAction($id) {
		$this->view->video = Video::findFirst($id);
		\Phalcon\Tag::setTitle($this->view->video->name);
		\Phalcon\Tag::appendTitle($this->appendTitle);
	}
	
	protected function deployPaginator($data) {
		$currentPage = !empty($_GET["page"]) ? (int)$_GET["page"] : 1;
		$paginator = new \Phalcon\Paginator\Adapter\Model(
				array(
					"data" => $data,
					"limit" => $this->videoPerPage,
					"page" => $currentPage
				)
		);

		return $paginator->getPaginate();
	}
}