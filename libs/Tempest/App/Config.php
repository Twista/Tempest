<?php

/**
 * Description of Config
 * provides application configuration
 *
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
 * @category Tempest\App
 */

namespace Tempest\App;

class Config extends \Tempest\PropertyAccess {

	private $basePath = '/';

	public function setBasePath($path){
		$this->basePath = $path;
	}

	public function getBasePath(){
		return $this->basePath;
	}

}