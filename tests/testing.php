<?php
echo 'test - mode<br>';

// routes

$routes = array(
	'posts' =>	'PostController:showAll',
	'post/:id' => 'PostController:showPost'
	);

/** @deprecated */
//$router = new Tempest\Routing\SimpleRouter($routes);

$router = new Tempest\Routing\Router($routes);
$router->dispatch();

// di

$di = new Tempest\DI();
$class = new stdClass();
var_dump($class);
$di->set('Test1',$class);
var_dump($di->get('Test1'));

