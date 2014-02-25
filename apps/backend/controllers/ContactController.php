<?php

namespace Shagtv\Backend\Controllers;

use Shagtv\Backend\Models\Contact;

class ContactController extends ControllerBase {

	public function initialize()
    {
        $this->view->setTemplateAfter('main');
        \Phalcon\Tag::setTitle('Редактирование контактов');
        parent::initialize();
    }

	public function indexAction() {
		$this->view->contacts = Contact::find();
	}
}
