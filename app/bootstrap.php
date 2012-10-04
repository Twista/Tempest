<?php
/* DEV ONLY ***/
// require nette\debugger for tests :)
require_once LIB_DIR . '/Tempest/Extras/NDebugger.php';

NDebugger::$strictMode = TRUE;
NDebugger::enable();

if($testMode){ // run test script :)
	require('../tests/testing.php');
	die();
}

/* DEV ONLY - END ***/

// register autoloader
$loader = \Tempest\Loaders\Autoloader::getInstance();
$loader->addDirs(array(
	APP_DIR,
	APP_DIR.'/presenters',
	APP_DIR.'/models'
	))->register();


$routes = array(
	'posts' =>	'Post:showAll',
	'/' =>	'Post:showAll',
	'post/[id]' => 'Post:showPost',
	'[presenter]/[action]' => '[presenter]:[action]',
	);

$di = Tempest\DI\ContainerFactory::create();

$di->set('router',function() use ($routes){
	return new Tempest\Routing\Router($routes);
});

// create instance of Tempest\Application
$app = new Tempest\App\Application($di);

// run run run!
$app->run();
