<?php

/**
 * Description of Tempest loader
 * initialization file
 *
 * @author Michal Haták [Twista] <hatakvinizio.cz>
 * @package Tempest
 */

error_reporting(E_ALL | E_STRICT);
@header('Content-Type: text/html; charset=utf-8'); // @ - headers may be sent

require_once '/common/Object.php';
require_once '/Loaders/Autoloader.php';

Tempest\Loaders\AutoLoader::getInstance()->register();

?>
