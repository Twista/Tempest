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

$routes = array(
	'[presenter]/[action]' => '[presenter]:[action]',
	'posts' =>	'PostPresenter:showAll',
	'/' =>	'PostPresenter:showAll',
	'post/[id]' => 'PostPresenter:showPost'
	);

$di = new Tempest\DI();

$di->set('router',function() use ($routes){
	return new Tempest\Routing\Router($routes);
});

// create instance of Tempest\Application
$app = new Tempest\App\Application($di);

// run run run!
$app->run();
