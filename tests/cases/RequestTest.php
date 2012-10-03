<?php

class RequestTest extends PHPUnit_Framework_TestCase{

	private $req;

	public function setUp(){
		$this->req = new \Tempest\Routing\Request();
	}

	public function testSimple(){

		/* request class was refactored, have to rewrite tests
		/*
		$this->assertEquals('T1',$this->req->class);
		$this->assertEquals('action',$this->req->action);
		$this->assertEquals(3,$this->req->params['id']);
		$this->assertEquals('tempest',$this->req->params['name']);
		*/
	}

}