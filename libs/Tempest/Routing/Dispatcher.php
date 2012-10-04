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
     * @todo refact - too long
     */
    private function presenterFactory(){
        $targetRoute = explode(':',$this->processTarget($this->route->getTarget(),$this->route->getParams));
        if (sizeof($targetRoute) != 2)
            throw new \Exception('Wrong route target, please type Class:method');

        $class = array_shift($targetRoute);
        $method = array_shift($targetRoute);

        // add default postfixes
        $class_name = $class.'Presenter';
        $method_name = $method.'Action';


        if(!class_exists($class_name))
            throw new \Exception("Class {$class_name}Presenter doesn't exists");

        $obj = new $class_name();
        if($obj instanceof \Tempest\MVC\Presenter){
            $obj->injectDI($this->di);
            $obj->initTemplate($class.DIRECTORY_SEPARATOR.$method.'.pht');
        }

        if(method_exists($obj, 'beforeRender'))
            $obj->beforeRender();

        $params = is_null($this->route->getParams()) ? array() : array_values($this->route->getParams());
        if(!method_exists($obj, $method_name))
            throw new \Exception("Method {$class_name}::{$method_name} doesn't exists");

        call_user_func_array(array($obj, $method_name), $params);

        if(method_exists($obj, 'renderTemplate'))
            $obj->renderTemplate();

        if(method_exists($obj, 'afterRender'))
            $obj->afterRender();
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