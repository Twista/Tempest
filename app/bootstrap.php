<?php

// require nette\debugger for tests :)
require_once LIB_DIR . '/Tempest/Extras/NDebugger.php';

NDebugger::$strictMode = TRUE;
NDebugger::enable();

// tempest - start

require_once LIB_DIR . '/Tempest/loader.php';

if($testMode){ // run test script :)
	require('../tests/testing.php');
	die();
}


$routes = array(
	'posts' =>	'PostController:showAll',
	'post/:id/:year' => 'PostController:showPost'
	);


// create instance of Tempest\Application
$app = new Tempest\App\Application();

// set Router w/ routes
$app->setRouter(new Tempest\Routing\Router($routes));

// run run run!
$app->run();
