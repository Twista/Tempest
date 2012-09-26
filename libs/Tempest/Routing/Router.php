<?php

/**
 * Description of Router
 *
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
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
        $route = new Route();

        $route->setUrl($routeURL);
        $route->setTarget($target);

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
    private function match() {
        if (sizeof($this->routes) == 0)
            Throw New \Exception('No routes Defined');

        $requestMethod = (isset($_POST['_method']) && ($_method = strtoupper($_POST['_method'])) && in_array($_method,array('PUT','DELETE'))) ? $_method : $_SERVER['REQUEST_METHOD'];
        $requestUrl = $_SERVER['REQUEST_URI'];

        // strip GET variables from URL
        if(($pos = strpos($requestUrl, '?')) !== false) {
            $requestUrl =  substr($requestUrl, 0, $pos);
        }

        if(empty($requestUrl))
            return array_shift($this->routes);

        foreach ($this->routes as $route) {

            // compare server request method with route's allowed http methods
            if(!in_array($requestMethod, $route->getMethods())) continue;

            // check if request url matches route regex. if not, return false.
            if (!preg_match("@^" . $route->getRegex() . "*$@i", $requestUrl, $matches))
                continue;

            if (preg_match_all("/:([\w-]+)/", $route->getUrl(), $argument_keys)) {

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

        //if fail - return first
        return array_shift($this->routes);
    }

    /**
     * Dispatch current request
     */
    public function dispatch() {
        $route = $this->match();

        $routeTarget = explode(':', $route->getTarget());
        if (sizeof($routeTarget) != 2)
            throw new \Exception('Wrong route target, please type Class:method');

        $class = array_shift($routeTarget);
        $method = array_shift($routeTarget);
        $obj = new $class();
        $params = is_null($route->getParams()) ? array() : array_values($route->getParams());
        return call_user_func_array(array($obj, $method), $params);
    }

}

