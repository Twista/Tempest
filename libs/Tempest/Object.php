<?php

/**
 * Description of Router
 *
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
 */

namespace Tempest;

abstract class Object {

    public function __get($varName) {

    	if(isset($this->$varName))
		    return $this->$varName;

		if (method_exists($this, $methodName = 'get'.ucfirst($varName)))
		    return $this->$methodName();

		if (method_exists($this, $varName))
		    return $this->$varName();

		trigger_error($varName . ' is not avaliable .', E_USER_ERROR);
    }

    public function __set($varName, $value) {
		if (method_exists($this, $MethodName = 'set_' . $varName))
		    return $this->$MethodName($value);

		trigger_error($varName . ' is not avaliable .', E_USER_ERROR);
    }

}

?>
