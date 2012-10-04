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
    * process parameters to target (class:action)
    * @param string $target
    * @param array $params
    * @return string
    */
    private function processTarget($target,$params){
        $targetParams = array();
        foreach ($params as $key => $value) {
            $targetParams['['.$key.']'] = $value;
        }

        return strtr($target,$targetParams);
    }

	/**
     * Dispatch current request
     * @return mixed
     */
    public function dispatch() {
        echo "used route - " . $this->route->getUrl();
        $targetRoute = explode(':',$this->processTarget($this->route->getTarget(),$this->route->getParams));
        if (sizeof($targetRoute) != 2)
            throw new \Exception('Wrong route target, please type Class:method');

        $class = array_shift($targetRoute);
        $method = array_shift($targetRoute);
        $obj = new $class();
        $params = is_null($this->route->getParams()) ? array() : array_values($this->route->getParams());
        return call_user_func_array(array($obj, $method), $params);
    }
}