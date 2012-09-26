<?php

$testMode = true;

// public directory
define('WEB_DIR', __DIR__);

// application folder
define('APP_DIR', WEB_DIR . '/../app');

// libraries folder
define('LIB_DIR', WEB_DIR . '/../libs');

define('TEMP_DIR', WEB_DIR . '/../temp');

require_once LIB_DIR . '/Tempest/loader.php';

// load bootstrap file
//if(!isset($phpUnit_started))
if(!defined('PHPUNIT_TESTSUITE'))
	require APP_DIR . '/bootstrap.php';
