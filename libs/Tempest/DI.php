<?php

/**
 * Description of IoC
 *
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
 */

namespace Tempest;

class DI {

    /**
     * services registry
     * @var array
     */
    private $registry = array();

    /**
    * created services
    * @var array
    */
    private $services = array();

    /**
     * add new service
     * @param string $name
     * @param mixed $service
     * @param array $args
     * @todo singletons ?
     */
    public function set($name, $class, $args = array()) {
        $this->registry[$name] = array(
            'class' => $class,
            'params' => $args,
            );
    }

    /**
     * get service from registry
     * @param string $name
     * @return object
     * @throws Exception
     */
    public function get($name) {
        if (!isset($this->registry[$name]))
            throw new Exception('Service with ' . $name . ' isn\'t defined');

        if(is_object($this->registry[$name]['class']))
            return $this->registry[$name]['class'];

        // creating an instance of the class
        if(count($this->registry[$name]['params']) == 0) {
           $obj = new $this->registry[$name]['class'];
        } else {
            $params = $this->registry[$name]['params'];
            if(!is_array($params)) {
                $params = array($params);
            }
            $reflection = new ReflectionClass($this->registry[$name]['class']);
            $obj = $reflection->newInstanceArgs($params);
        }


        return $obj;
    }
}
