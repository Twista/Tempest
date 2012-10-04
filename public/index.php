<?php

$testMode = false;

// public directory
define('WEB_DIR', __DIR__);

// application folder
define('APP_DIR', WEB_DIR . '/../app');

// libraries folder
define('LIB_DIR', WEB_DIR . '/../libs');

//folder for temporary files
define('TEMP_DIR', WEB_DIR . '/../temp');

//define project basepath
define('BASE_PATH','/tempest/');

// require loader
require_once LIB_DIR . '/Tempest/loader.php';

//if(!isset($phpUnit_started))
if(!defined('PHPUNIT_TESTSUITE'))
	require APP_DIR . '/bootstrap.php';
