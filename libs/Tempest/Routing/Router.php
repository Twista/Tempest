<?php

/**
 * Description of Router
 *
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
 * @category Tempest\Routing
 */

namespace Tempest\Routing;

class Router extends \Tempest\Object implements IRouter {

    /** @var array */
    private $routes = array();

    /**
     * constructor
     * @param array $routes
     */
    public function __construct($routes = array()) {
        if (!empty($routes))
            $this->addArrayRoutes($routes);
    }
    /**
    * add routes from array
    * @param array
    */
    public function addArrayRoutes($routes){
        if(!is_array($routes))
            throw new \Exception("routes must be an array");

        foreach ($routes as $route => $target) {
                $this->addRoute($route, $target);
            }
    }

    /**
     * add new route
     * @param string $routeURL
     * @param string $target write as Class:action
     */
    public function addRoute($routeURL, $target, $args = null) {
        $route = new Route($routeURL,$target);

        if(isset($args['methods'])) {
            $methods = explode(',', $args['methods']);
            $route->setMethods($methods);
        }

        if(isset($args['filters'])) {
            $route->setFilters($args['filters']);
        }

        $this->routes[] = $route;
    }

    /**
     * Match current request against routes
     * @return string
     */
    public function match(Request $request) {
        if (!$this->hasRoutes())
            Throw New \Exception('No routes Defined');

        foreach ($this->routes as $route) {

            // compare server request method with route's allowed http methods
            if(!in_array($request->method, $route->getMethods())) continue;

            // check if request url matches route regex. if not, return false.
            if (!preg_match("@^" . $route->getRegex() . "*$@i", $request->uri, $matches))
                continue;

            if (preg_match_all("/\[([\w-]+)\]/", $route->getUrl(), $argument_keys)) {

                // grab array with matches
                $argument_keys = $argument_keys[1];

                // loop trough parameter names, store matching value in $params array
                foreach ($argument_keys as $key => $name) {
                    if (isset($matches[$key + 1]))
                        $params[$name] = $matches[$key + 1];
                }
            }

            if (isset($params))
                $route->setParams($params);

            return $route;
        }

        throw new \Exception("Route Not Found", 404);

    }

    /**
    * check if some route is defined
    * @return bool
    */
    private function hasRoutes(){
        return (bool)count($this->routes);
    }

}

