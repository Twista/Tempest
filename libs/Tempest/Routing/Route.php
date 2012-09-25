<?php

/**
 * Description of Route
 *
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
 */

namespace Tempest\Routing;

class Route extends \Tempest\Object {

	/**
	* URL of this Route
	* @var string
	*/
	private $url;

	private $params;

	private $filters = array();

	/**
	* Target for this route, can be anything.
	* @var mixed
	*/
	private $target;


	public function getUrl() {
		return $this->url;
	}

	public function setUrl($url) {
		$url = (string) $url;

		// make sure that the URL is suffixed with a forward slash
		if(substr($url,-1) !== '/') $url .= '/';

		$this->url = $url;
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

	public function setParams(array $params) {
		$this->params = $params;
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

