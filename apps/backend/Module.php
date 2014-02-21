<?php

namespace Shagtv\Backend;

use Phalcon\Loader,
	Phalcon\Mvc\Dispatcher,
	Phalcon\Mvc\View,
	Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface {

	/**
	 * Регистрация автозагрузчика, специфичного для текущего модуля
	 */
	public function registerAutoloaders() {

		$loader = new Loader();

		$loader->registerNamespaces(
				array(
					'Shagtv\Backend\Controllers' => '../apps/backend/controllers/',
					'Shagtv\Backend\Models' => '../apps/backend/models/',
					'Shagtv\Backend\Plugins' => '../apps/backend/plugins/',
					'Shagtv\Backend\Library' => '../apps/backend/library/',
				)
		);

		$loader->register();
	}

	/**
	 * Регистрация специфичных сервисов для модуля
	 */
	public function registerServices($di) {

		$config = new \Phalcon\Config\Adapter\Ini('../apps/backend/config/config.ini');

		// Регистрация диспетчера
		$di->set('dispatcher', function() use ($di) {

			//Obtain the standard eventsManager from the DI
			$eventsManager = $di->getShared('eventsManager');

			//Instantiate the Security plugin
			$security = new \Shagtv\Backend\Plugins\Security($di);

			//Listen for events produced in the dispatcher using the Security plugin
			$eventsManager->attach('dispatch', $security);

			$dispatcher = new Dispatcher();
			//Bind the EventsManager to the Dispatcher
			$dispatcher->setEventsManager($eventsManager);
			$dispatcher->setDefaultNamespace("Shagtv\Backend\Controllers\\");
			return $dispatcher;
		});

		//Start the session the first time a component requests the session service
		$di->set('session', function() {
			$session = new \Phalcon\Session\Adapter\Files();
			$session->start();
			return $session;
		});

		// Регистрация компонента представлений
		$di->set('view', function() {
			$view = new View();
			$view->setViewsDir('../apps/backend/views/');
			return $view;
		});

		$di->set('elements', function() {
			return new \Shagtv\Backend\Library\Elements();
		});

		$di->set('flash', function() {
			return new \Phalcon\Flash\Direct(array(
				'error' => 'alert alert-error',
				'success' => 'alert alert-success',
				'notice' => 'alert alert-info',
			));
		});

		//Setup the database service
		$di->set('db', function() use ($config) {
			return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
				"host" => $config->database->host,
				"username" => $config->database->username,
				"password" => $config->database->password,
				"dbname" => $config->database->name
			));
		});
	}

}