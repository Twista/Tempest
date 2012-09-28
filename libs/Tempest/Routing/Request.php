<?php

/**
 * Description of Basic Request
 *
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
 */

namespace Tempest\Routing;

class Request extends \Tempest\PropertyAccess {

	public $class;

	public $action;

	public $params;

	public function __construct($class,$action,$params = array()){
		$this->class = $class;
		$this->action = $action;
		$this->params = $params;
	}

	public function getClass(){
		return $this->class;
	}

	public function getAction(){
		return $this->asction;
	}

	public function getParams(){
		return json_decode(json_encode($this->params));
	}

}