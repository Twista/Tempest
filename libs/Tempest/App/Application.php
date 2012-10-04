<?php

/**
 * Description of Application
 *
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
 * @category Tempest\App
 */

namespace Tempest\App;

class Application extends \Tempest\Object {

    /** @var Tempest\Container */
    private $di;

    public function __construct(\Tempest\DI\Container $di) {
        $this->di = $di;
    }

    public function run() {
        $router = $this->di->getShared('router');
        $dispatcher = $this->di->getShared('dispatcher');
        $request = $this->di->getShared('request');


        $dispatcher->setRoute($router->match($request));
        $dispatcher->setInjectedDependencies($this->di)
            ->dispatch();
    }

}