<?php

$routes = array(
	'posts' =>	'PostController:showAll',
	'post/:id/:year' => 'PostController:showPost'
	);

/** @deprecated */
//$router = new Tempest\Routing\SimpleRouter($routes);

$router = new Tempest\Routing\Router($routes);

$router->dispatch();