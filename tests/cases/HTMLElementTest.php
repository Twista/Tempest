<?php

/**
 * Description of HTMLElementTest
 *
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
 */


class HTMLElementTest extends PHPUnit_Framework_TestCase{

    public function test1(){
    	$img = new Tempest\Utils\HTMLElement('img');
		$img->src = '/vnb.png';
		$img->alt = 'Test';

		$a = new Tempest\Utils\HTMLElement('a');
		$a->href= 'http://twista.cz';
		$a->target = '_blank';
		$a->pair();
		$a->content = $img;

    	$this->assertEquals('<a href="http://twista.cz" target="_blank"><img src="/vnb.png" alt="Test" /></a>',$a->createElement());

    	$br = new Tempest\Utils\HTMLElement('br');
    	$this->assertEquals('<br />',$br->createElement());
    	$br->pair();
    	$this->assertEquals('<br></br>',$br->createElement());
    	$br->notPair();
    	$this->assertEquals('<br />',$br->createElement());
    	$br->src = 'abc';
    	$this->assertEquals('<br src="abc" />',$br->createElement());

    }
}
