<?php

/**
 * Description of Basic Request
 *
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
 * @category Tempest\Routing
 */

namespace Tempest\Routing;

class Request extends \Tempest\PropertyAccess {

	/** @var string */
	public $uri;

	/** @var string */
	public $method;

	/** @var array */
	private $aviableMethods = array('GET','POST','PUT','DELETE');

	/**
	* contructor
	* @param string $uri
	* @param string $method
	*/
	public function __construct($uri = null,$method = null){

		$this->method = $this->getCurrentMethod($method);

        $this->uri = (is_null($uri)) ? $_SERVER['REQUEST_URI'] : $uri;

        // strip GET variables from URL
        if(($pos = strpos($this->uri, '?')) !== false) {
            $this->uri =  substr($this->uri, 0, $pos);
        }
	}

	/**
	* get method of current request
	* @param mixed $method
	* @return string
	*/
	private function getCurrentMethod($method){
		if(!is_null($method))
			return $method;

		return (isset($_POST['_method']) && ($method = strtoupper($_POST['method'])) && in_array($method,$this->aviableMethods)) ? $method : $_SERVER['REQUEST_METHOD'];
	}

	/**
	* uri getter
	* @return string
	*/
	public function getUri(){
		return $this->uri;
	}

	/**
	 * method getter
	 * @return string
	 */
	public function getMethod(){
		return $this->method;
	}

}