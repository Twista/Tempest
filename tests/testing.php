<?php
echo 'test - mode<br>';

// routes

$routes = array(
	'posts' =>	'PostController:showAll',
	'post/:id' => 'PostController:showPost'
	);

$router = new Tempest\Routing\Router($routes);
$router->routes[] = new Route();

$dispatcher = new Tempest\Routing\Dispatcher($router);

//$router->dispatch();

//request

$req = new Tempest\Routing\Request();
echo('<pre>'); print_r($req); echo('</pre>');


// di

$di = new Tempest\DI();
$class = new stdClass();
var_dump($class);
$di->set('Test1',$class);
var_dump($di->get('Test1'));

