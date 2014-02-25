<?php

namespace Shagtv\Backend\Plugins;

use Phalcon\Events\Event,
	Phalcon\Mvc\User\Plugin,
	Phalcon\Mvc\Dispatcher,
	Phalcon\Acl;

/**
 * Security
 *
 * This is the security plugin which controls that users only have access to the modules they're assigned to
 */
class Security extends Plugin {

	public function __construct($dependencyInjector) {
		$this->_dependencyInjector = $dependencyInjector;
	}

	public function getAcl() {
		if (!isset($this->persistent->aclAdmin)) {

			$acl = new \Phalcon\Acl\Adapter\Memory();

			$acl->setDefaultAction(\Phalcon\Acl::DENY);

			//Register roles
			$roles = array(
				'admin' => new \Phalcon\Acl\Role('Admin'),
				'users' => new \Phalcon\Acl\Role('Users'),
				'guests' => new \Phalcon\Acl\Role('Guests')
			);
			foreach ($roles as $role) {
				$acl->addRole($role);
			}

			//Private area resources
			$privateResources = array(
				'index' => array('index'),
				'contact' => array('index'),
				'user' => array('index'),
				'video' => array('index', 'edit', 'delete'),
			);

			foreach ($privateResources as $resource => $actions) {
				$acl->addResource(new \Phalcon\Acl\Resource($resource), $actions);
			}

			//Public area resources
			$publicResources = array(
			);

			foreach ($publicResources as $resource => $actions) {
				$acl->addResource(new \Phalcon\Acl\Resource($resource), $actions);
			}

			//Grant access to public areas to both users and guests
			foreach ($roles as $role) {
				foreach ($publicResources as $resource => $actions) {
					$acl->allow($role->getName(), $resource, '*');
				}
			}

			//Grant acess to private area to role Users
			foreach ($privateResources as $resource => $actions) {
				foreach ($actions as $action) {
					$acl->allow('Admin', $resource, $action);
				}
			}

			//The acl is stored in session, APC would be useful here too
			$this->persistent->aclAdmin = $acl;
		}

		return $this->persistent->aclAdmin;
	}

	/**
	 * This action is executed before execute any action in the application
	 */
	public function beforeDispatch(Event $event, Dispatcher $dispatcher) {

		$auth = $this->session->get('auth');
		if (empty($auth['role'])) {
			$role = 'Guests';
		} else {
			$role = $auth['role'];
		}

		$controller = $dispatcher->getControllerName();
		$action = $dispatcher->getActionName();
		
		$acl = $this->getAcl();

		$allowed = $acl->isAllowed($role, $controller, $action);

		if ($allowed != Acl::ALLOW) {
			$this->flash->error("You don't have access to this module");
			$dispatcher->forward(
					array(
						'controller' => 'index',
						'action' => 'index'
					)
			);
			return false;
		}
	}

}
