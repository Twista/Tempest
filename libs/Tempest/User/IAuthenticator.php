<?php

/**
 * Description of IAuthenticator
 *
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
 * @category Tempest\User
 */

namespace Tempest\User;

interface IAuthenticator {
	/**
	 * login function
	 * @param  int $id   user id
	 * @param  string $pass user pasword
	 * @return bool
	 */
	public function login($id,$pass);
}