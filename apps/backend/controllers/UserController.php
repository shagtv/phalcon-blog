<?php

namespace Shagtv\Backend\Controllers;

use Shagtv\Backend\Models\Users;

class UserController extends ControllerBase {

	public function initialize()
    {
        $this->view->setTemplateAfter('main');
        \Phalcon\Tag::setTitle('Администрировие');
        parent::initialize();
    }

	public function indexAction() {
		$this->view->users = Users::find();
	}
}
