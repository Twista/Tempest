<?php

/**
 * Description of Mail
 *
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
 * @category Tempest\Utils
 */

namespace Tempest\Utils;

class Mail {

	/** @var string */
	private $to;

	/** @var string */
	private $subject;

	/** @var string */
	private $body;

	/** @var string */
	private $sender;

	public function __construct(){

	}

	/**
	 * set sender
	 * @param string $sender
	 * @return \Tempest\Utils\Mail
	 */
	public function from($sender){
		$this->sender = $sender;
		return $this;
	}

	/**
	 * set target
	 * @param string $to
	 * @return \Tempest\Utils\Mail
	 */
	public function to($to){
		$this->to = $to;
		return $this;
	}

	/**
	 * set body
	 * @param string $body
	 * @return \Tempest\Utils\Mail
	 */
	public function body($body){
		$this->body = $body;
		return $this;
	}

	/**
	 * set subject
	 * @param string $subject
	 * @return \Tempest\Utils\Mail
	 */
	public function subject($subject){
		$this->subject = $subject;
	}

	/**
	 * send mail
	 * @retrun bool
	 */
	public function send(){
		$headers = '';
		$headers .= (!empty($this->from)) ? 'From: ' . $this->from . PHP_EOL : '';
		return mail($this->to, $this->subject, $this->body, $headers);
	}

}