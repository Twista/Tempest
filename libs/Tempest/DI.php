<?php

/**
 * Description of IoC Container
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

        $class_name = $this->registry[$name]['class'];

        if(is_object($class_name))
            return $class_name;

        if(!class_exists($class_name))
            throw new Exception("Class {$class_name} doesnt exists.");


        // creating an instance of the class
        if(count($this->registry[$name]['params']) == 0) {
           $obj = new $class_name;
        } else {
            $params = $this->registry[$name]['params'];
            if(!is_array($params)) {
                $params = array($params);
            }
            $reflection = new ReflectionClass($class_name);
            $obj = $reflection->newInstanceArgs($params);
        }


        return $obj;
    }
}
