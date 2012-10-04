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

	public function initTemplate($template){
		$this->template = new \Tempest\Templating\Template(APP_DIR.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$template);
	}

	public function renderTemplate(){
		echo '<h3>render!</h3>';
		$this->template->render();
	}

}