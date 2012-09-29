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

    /** @var Tempest\Routing\IRoute */
    private $router;

    public function __construct() {

    }

    public function setRouter(IRouter $router) {
        $this->router = $router;
    }

    public function run() {
        $this->router->dispatch();
    }

}