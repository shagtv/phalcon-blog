<?php

namespace Shagtv\Backend\Controllers;

class ControllerBase extends \Phalcon\Mvc\Controller {

	protected function initialize() {
		//append the application name to the title
		\Phalcon\Tag::appendTitle(' | Shagtv.net');
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
	
	protected function redirect($uri){
    	$response = new \Phalcon\Http\Response();
		return $response->redirect($uri);
    }
}
