<?php

namespace Shagtv\Frontend\Controllers;

class UserController extends ControllerBase {

	public function initialize()
    {
        //Set the document title
        $this->tag->setTitle('Manage users');
        parent::initialize();
    }

	/**
	 * The start action, it shows the "search" view
	 */
	public function indexAction() {
		$this->persistent->searchParams = null;
		$this->view->users = Users::find();
	}

	/**
	 * Execute the "search" based on the criteria sent from the "index"
	 * Returning a paginator for the results
	 */
	public function searchAction() {
		//...
	}

	/**
	 * Shows the view to create a "new" product
	 */
	public function newAction() {
		if ($this->request->isPost()) {
			$user = new Users();
			//Store and check for errors
			$success = $user->save($this->request->getPost(), array('login', 'password'));
			if ($success) {
				$this->response->redirect("user/index");
			}
		}
	}

	/**
	 * Shows the view to "edit" an existing product
	 */
	public function editAction($login) {
		if ($this->request->isPost()) {
			$user = new Users();
			//Store and check for errors
			$success = $user->update($this->request->getPost(), array('login', 'password'));
			$this->response->redirect("user/index");
		}
		$this->view->user = Users::findFirst(compact('login'));
	}

	/**
	 * Creates a product based on the data entered in the "new" action
	 */
	public function createAction() {
		//...
	}

	/**
	 * Updates a product based on the data entered in the "edit" action
	 */
	public function saveAction() {
		//...
	}

	/**
	 * Deletes an existing product
	 */
	public function deleteAction($login) {
		$user = Users::findFirst(compact('login'));
		//Store and check for errors
		$user->delete();
		$this->response->redirect("user/index");
	}

}
