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
        $router = $this->di->get('router');
        $dispatcher = new \Tempest\MVC\Dispatcher($router->match(new \Tempest\Routing\Request()));
        $dispatcher->setInjectedDependencies($this->di)
            ->dispatch();
    }

}