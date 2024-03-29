<?php

class ControllerBase extends \Phalcon\Mvc\Controller {

	protected $appendTitle = ' | Shagtv.net';


	protected function initialize() {
		//append the application name to the title
		\Phalcon\Tag::appendTitle($this->appendTitle);
		$this->view->description = "Обучающие видео по программированию, видеоуроки, статьи, онлайн утилиты.";
		$this->view->keywords = "ubuntu,video,видео,обучение,php,mysql,mongodb";
	}
	
	protected function forward($uri){
    	$uriParts = explode('/', $uri);
    	return $this->dispatcher->forward(
    		array(
    			'controller' => $uriParts[0], 
    			'action' => $uriParts[1]
    		)
    	);
    }
}
