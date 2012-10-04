<?php

/**
 * Description of Presenter
 *
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
 * @category Tempest\MVC
 */

namespace Tempest\MVC;

abstract class Presenter {

	/** @var string */
	protected $template;

	/** @var \Tempest\DI */
	protected $di;

	/**
	 * inject DI Container
	 * @param \Tempest\DI $di
	 */
	public function injectDI(\Tempest\DI $di){
		$this->di = $di;
		echo '<h1>DI was injected</h1>';
	}

}