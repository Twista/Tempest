<?php

/**
 * Description of ContainerFactory
 * factory class for DI container, create new container instance and set default services
 *
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
 * @category Tempest\DI
 */

namespace Tempest\DI;

class ContainerFactory {

	static public function create(){

		//@todo make cantainer as singleton
		$di = new Container();

		$di->set('request', new \Tempest\Routing\Request());
		$di->set('dispatcher', new \Tempest\MVC\Dispatcher());

		return $di;

	}

}