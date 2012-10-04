<?php
echo 'test - mode<br>';

// routes

$routes = array(
	'[presenter]/[action]' => '[presenter]:[action]',
	'posts' =>	'PostPresenter:showAll',
	'/' =>	'PostPresenter:showAll',
	'post/[id]' => 'PostPresenter:showPost'
	);

$router = new Tempest\Routing\Router($routes);
$router->addRoute('a/b','PostPresenter:showAll');

$dispatcher = new Tempest\Routing\Dispatcher($router->match(new Tempest\Routing\Request()));

$dispatcher->dispatch();




// di

$di = new Tempest\DI();
$class = new stdClass();
var_dump($class);
$di->set('Test1',$class);
var_dump($di->get('Test1'));

