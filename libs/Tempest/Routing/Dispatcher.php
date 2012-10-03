<?php

/**
 * Description of Dispatcher
 *
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
 * @category Tempest\Routing
 */

namespace Tempest\Routing;

class Dispatcher extends \Tempest\Object {

	/** @var Route */
	private $route;

	/**
	* constructor
	* @param Route $route
	*/
	public function __construct(Route $route){
		$this->route = $route;
	}

	/**
     * Dispatch current request
     * @return mixed
     */
    public function dispatch() {

        $routeTarget = explode(':', $this->route->getTarget());
        if (sizeof($routeTarget) != 2)
            throw new \Exception('Wrong route target, please type Class:method');

        $class = array_shift($routeTarget);
        $method = array_shift($routeTarget);
        $obj = new $class();
        $params = is_null($this->route->getParams()) ? array() : array_values($this->route->getParams());
        return call_user_func_array(array($obj, $method), $params);
    }
}