<?php

namespace Shagtv\Frontend\Controllers;

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
}
