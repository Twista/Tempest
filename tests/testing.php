<?php
echo 'test - mode<br>';

// routes

$routes = array(
	'[controller]/[action]' => '[controller]:[action]',
	'posts' =>	'PostController:showAll',
	'/' =>	'PostController:showAll',
	'post/[id]' => 'PostController:showPost'
	);

$router = new Tempest\Routing\Router($routes);
$router->addRoute('a/b','PostController:showAll');

$dispatcher = new Tempest\Routing\Dispatcher($router->match(new Tempest\Routing\Request()));

$dispatcher->dispatch();

//request

$req = new Tempest\Routing\Request();
echo('<pre>'); print_r($req); echo('</pre>');


// di

$di = new Tempest\DI();
$class = new stdClass();
var_dump($class);
$di->set('Test1',$class);
var_dump($di->get('Test1'));

