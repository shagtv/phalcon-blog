<?php

try {

	//Read the configuration
	$config = new Phalcon\Config\Adapter\Ini('../app/config/config.ini');

	//Register an autoloader
	$loader = new \Phalcon\Loader();
	$loader->registerDirs(array(
		$config->application->controllersDir,
		$config->application->modelsDir,
	))->register();

	//Create a DI
	$di = new Phalcon\DI\FactoryDefault();

	//Start the session the first time a component requests the session service
	$di->set('session', function() {
		$session = new Phalcon\Session\Adapter\Files();
		$session->start();
		return $session;
	});

	//Setup the database service
	$di->set('db', function() use ($config) {
		$db = new \Phalcon\Db\Adapter\Pdo\Mysql(array(
			"host" => $config->database->host,
			"username" => $config->database->username,
			"password" => $config->database->password,
			"dbname" => $config->database->name,
			"charset" => 'utf8'
		));
		$db->execute('SET NAMES UTF8', array());
		return $db;
	});

	//Setup the view component
	$di->set('view', function() {
		$view = new \Phalcon\Mvc\View();
		$view->setViewsDir('../app/views/');
		return $view;
	});

	$di->set('dispatcher', function() use ($di) {

		//Obtain the standard eventsManager from the DI
		$eventsManager = $di->getShared('eventsManager');

		$dispatcher = new Phalcon\Mvc\Dispatcher();

		//Bind the EventsManager to the Dispatcher
		$dispatcher->setEventsManager($eventsManager);

		return $dispatcher;
	});

	/**
	 * Register the flash service with custom CSS classes
	 */
	$di->set('flash', function() {
		return new Phalcon\Flash\Direct(array(
			'error' => 'alert alert-error',
			'success' => 'alert alert-success',
			'notice' => 'alert alert-info',
		));
	});

	/**
	 * The URL component is used to generate all kind of urls in the application
	 */
	$di->set('url', function() use ($config) {
		$url = new \Phalcon\Mvc\Url();
		$url->setBaseUri($config->application->baseUri);
		return $url;
	});

	$di->set('router', function() {
		// Создание маршрутизатора
		$router = new \Phalcon\Mvc\Router();

		// Определение правила маршрутизации
		$router->add(
				"/:controller/:action/:params", array(
			"controller" => ucfirst(1),
			"action" => strtolower(2),
			"params" => 3,
				)
		);

		$router->handle();
		return $router;
	});

	/**
	 * Register a user component
	 */
	$di->set('elements', function() {
		return new Elements();
	});

	//Handle the request
	$application = new \Phalcon\Mvc\Application();
	$application->setDI($di);
	echo $application->handle()->getContent();
} catch (Phalcon\Exception $e) {
	echo $e->getMessage();
} catch (PDOException $e) {
	echo $e->getMessage();
}