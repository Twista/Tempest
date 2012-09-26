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
     * add new service
     * @param string $name
     * @param mixed $service
     * @todo add params to services
     */
    public function set($name, $service) {
        $this->registry[$name] = $service;
    }

    /**
     * get service from registry
     * @param string $name
     * @return object
     * @throws Exception
     */
    public function get($name) {
        if (!isset($this->registry[$name]))
            throw new Exception('Service with ' . $name . ' isnt defined');

        if (is_string($this->registry[$name])) {
            $this->registry[$name] = new $this->registry[$name]();
        }

        return $this->registry[$name];

    }
}
