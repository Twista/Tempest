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

    /** @var \Tempest\DI */
    private $di;

	/**
	* constructor
	* @param Route $route
	*/
	public function __construct(Route $route){
		$this->route = $route;
	}

    /**
     * set Dependenci container to inject via presenter factory
     * @param \Tempest\DI $di
     * @return Dispatcher
     */
    public function setInjectedDependencies(\Tempest\DI $di){
        $this->di = $di;
        return $this;
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
     * basic presenter factory
     * @param string $target
     * @return object
     */
    private function presenterFactory(){
        $targetRoute = explode(':',$this->processTarget($this->route->getTarget(),$this->route->getParams));
        if (sizeof($targetRoute) != 2)
            throw new \Exception('Wrong route target, please type Class:method');

        $class = array_shift($targetRoute);
        $method = array_shift($targetRoute);
        $obj = new $class();
        if($obj instanceof \Tempest\MVC\Presenter)
               $obj->injectDI($this->di);

        $params = is_null($this->route->getParams()) ? array() : array_values($this->route->getParams());
        return call_user_func_array(array($obj, $method), $params);

    }

	/**
     * Dispatch current request
     * @return mixed
     */
    public function dispatch() {
        if(is_object($this->route->getTarget()))
            return $this->route->getTarget();

        return $this->presenterFactory();
    }
}