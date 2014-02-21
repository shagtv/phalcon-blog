<?php

use Phalcon\Mvc\Router,
	Phalcon\Mvc\Application,
	Phalcon\DI\FactoryDefault;

$di = new FactoryDefault();

// Специфичные роуты для модуля
$di->set('router', function () {

	$router = new Router();

	$router->setDefaultModule("frontend");
	$router->setDefaultController("index");
	$router->setDefaultAction("index");
	
	$router->add("/admin/:controller/:action", array(
		'module' => 'backend',
		'controller' => ucfirst(1),
		'action' => strtolower(2),
	));
	
	$router->add("/:controller/:action", array(
		'module' => 'frontend',
		'controller' => ucfirst(1),
		'action' => strtolower(2),
	));

	return $router;
});

try {

	// Создание приложения
	$application = new Application($di);

	// Регистрация установленных модулей
	$application->registerModules(
			array(
				'frontend' => array(
					'className' => 'Shagtv\Frontend\Module',
					'path' => '../apps/frontend/Module.php',
				),
				'backend' => array(
					'className' => 'Shagtv\Backend\Module',
					'path' => '../apps/backend/Module.php',
				)
			)
	);

	// Обработка запроса
	echo $application->handle()->getContent();
} catch (\Exception $e) {
	echo $e->getMessage();
}