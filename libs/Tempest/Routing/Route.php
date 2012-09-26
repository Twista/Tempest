<?php

/**
 * Description of Route
 *
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
 */

namespace Tempest\Routing;

class Route extends \Tempest\Object {

    /** @var string */
    private $url;

    /** @var array */
    private $params = array();

    /** @var array */
    private $filters = array();

    /** @var mixed */
    private $target;

    private $methods = array('GET','POST','PUT','DELETE');

    /**
    * URL getter
    * @return string
    */
    public function getUrl() {
        return $this->url;
    }


    public function setUrl($url) {
        $url = (string) $url;

        // make sure that the URL is suffixed with a forward slash
        if (substr($url, -1) !== '/')
            $url .= '/';

        $this->url = BASE_PATH.$url;
    }

    public function getTarget() {
        return $this->target;
    }

    public function setTarget($target) {
        $this->target = $target;
    }

    public function getParams() {
        return $this->params;
    }

    public function setParams($params) {
        $this->params = $params;
    }

    public function setFilters(array $filters) {
        $this->filters = $filters;
    }

    public function setMethods($methods){
        $this->methods = $methods;
    }

    public function getMethods(){
        return $this->methods;
    }


    public function getRegex() {
        return preg_replace_callback("/:(\w+)/", array(&$this, 'substituteFilter'), $this->url);
    }

    private function substituteFilter($matches) {
        if (isset($matches[1]) && isset($this->filters[$matches[1]])) {
            return $this->filters[$matches[1]];
        }
        return "([\w-]+)";
    }
}

