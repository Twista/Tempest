<?php

class RequestTest extends PHPUnit_Framework_TestCase{

	public function testSimple(){

		$req = new \Tempest\Routing\Request('/','GET');
		$this->assertEquals('GET',$req->getMethod());
		$this->assertEquals('/',$req->getUri());
		/* request class was refactored, have to rewrite tests
		/*


		$this->assertEquals(3,$this->req->params['id']);
		$this->assertEquals('tempest',$this->req->params['name']);
		*/
	}

}