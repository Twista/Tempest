<?php

/**
 * Description of IoC Container
 *
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
 * @todo magic call method : getValue == get('value')
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
            'instance' => null,
            );
    }

    /**
     * get service from registry
     * @param string $name
     * @return object
     * @throws Exception
     */
    public function get($name,$args = array()) {
        if (!isset($this->registry[$name]))
            throw new Exception('Service with ' . $name . ' isn\'t defined');

        $class_name = $this->registry[$name]['class'];

        // return raw object
        if(is_object($class_name)){
            if(is_a($class_name,'Closure')) // closure have to be eval'd
                return $class_name();
            return $class_name;
        }

        if(!class_exists($class_name))
            throw new Exception("Class {$class_name} doesnt exists.");

        // merge class params
        $this->registry[$name]['params'] = array_merge($this->registry[$name]['params'],$args);

        // creating an instance of the class
        if(!$this->hasClassParams($this->registry[$name])) {
           $obj = new $class_name;
        } else {
            $params = $this->registry[$name]['params'];
            if(!is_array($params)) {
                $params = array($params);
            }
            $reflection = new ReflectionClass($class_name);
            $obj = $reflection->newInstanceArgs($params);
        }

        $this->registry[$name]['instance'] = $obj;
        return $obj;
    }

    /**
    * return last instanced class by name
    * singleton workaround
    * @param string $name
    * @throws Exception
    * @return Object
    */
    public function getShared($name){
        if(!isClassRegistred($name))
            throw new Exception('Service with ' . $name . ' isn\'t defined');

        if(!is_null($this->registry[$name]['instance']))
            return $this->registry[$name]['instance'];

        return $this->get($name);
    }

    /**
    * check if class has any params defined
    * @param string $class_name
    * @return bool
    */
    private function hasClassParams($class_name){
        return (bool)count($class_name['params']);
    }

    /**
    * check if class is defined
    * @param string $name
    * @return bool
    */
    private function isClassRegistred($name){
        return isset($this->registry[$name]);
    }
}
