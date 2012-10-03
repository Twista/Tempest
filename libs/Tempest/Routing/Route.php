<?php

/**
 * Description of Route
 *
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
 * @category Tempest\Routing
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

    /**
    * array of aviable methods
    * @var array
    */
    private $methods = array('GET','POST','PUT','DELETE');

    public function __construct($url,$target){
        $this->setUrl($url);
        $this->setTarget($target);
    }

    /**
    * URL getter
    * @return string
    */
    public function getUrl() {
        return $this->url;
    }

    /**
    * set route url
    * @todo remove BASE_PATH
    * @param string $url
    */
    public function setUrl($url) {
        $url = (string) $url;

        // make sure that the URL is suffixed with a forward slash
        if (substr($url, -1) !== '/')
            $url .= '/';

        $this->url = BASE_PATH.$url;
    }

    /**
     * target getter
     * @return mixed
     */
    public function getTarget() {
        return $this->target;
    }

    /**
     * target setter
     * @param mixed $target
     */
    public function setTarget($target) {
        $this->target = $target;
    }

    /**
     * params getter
     * @return array
     */
    public function getParams() {
        return $this->params;
    }

    /**
     * params setter
     * @param array $params
     */
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

    /**
     * get route regexps (with filters)
     * @return mixed
     */
    public function getRegex() {
        return preg_replace_callback("/\[(\w+)\]/", array(&$this, 'substituteFilter'), $this->url);
    }

    /**
     * apply route filters
     * @param array $matches
     * @return mixed
     */
    private function substituteFilter($matches) {
        if (isset($matches[1]) && isset($this->filters[$matches[1]])) {
            return $this->filters[$matches[1]];
        }
        return "([\w-]+)";
    }
}

