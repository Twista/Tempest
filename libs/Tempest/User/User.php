<?php

/**
 * Description of User
 *
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
 * @category Tempest\User
 */

namespace Tempest\User;

class User {

	private $Identity;

	private $Autentificator;

	public function __construct(IAuthenticator $auth){
		$this->autentificator = $auth;

	}

	public function login($id = null, $password = null){
		return $this->Identity = $this->autentificator->login(func_get_args());
	}

	public function getIdentity(){
		return $this->Identity;
	}
}