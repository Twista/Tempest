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

	/** @var \Tempest\Templating\Template */
	protected $template;

	/** @var string */
	protected $template_file;

	/** @var \Tempest\DI\Container */
	protected $di;

	/**
	 * inject DI Container
	 * @param \Tempest\DI $di
	 */
	public function injectDI(\Tempest\DI\Container $di){
		$this->di = $di;
		echo '<h1>DI was injected</h1>';
	}

	/**
	 * base init of template engine
	 * @param string $template
	 */
	public function initTemplate($template){
		$template_file = APP_DIR.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$template;
		if(is_readable($template_file)){
			$this->template_file = $template_file;
			$this->template = new \Tempest\Templating\Template($this->template_file);
		} else {
			$this->template_file = null;
		}
	}

	/**
	 * render template if is aviable
	 */
	public function renderTemplate(){
		if(!is_null($this->template_file))
			$this->template->render();
	}

}