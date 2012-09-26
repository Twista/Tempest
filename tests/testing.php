<?php
echo 'testing';
echo('<pre>'); print_r($_GET); echo('</pre>');
$routes = array(
	'posts' =>	'PostController:showAll',
	'post/:id' => 'PostController:showPost'
	);

/** @deprecated */
//$router = new Tempest\Routing\SimpleRouter($routes);

$router = new Tempest\Routing\Router($routes);

$router->dispatch();