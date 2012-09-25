<?php

$testMode = true;

// public directory
define('WEB_DIR', __DIR__);

// application folder
define('APP_DIR', WEB_DIR . '/../app');

// libraries folder
define('LIB_DIR', WEB_DIR . '/../libs');

define('TEMP_DIR', WEB_DIR . '/../temp');

// load bootstrap file
require APP_DIR . '/bootstrap.php';
