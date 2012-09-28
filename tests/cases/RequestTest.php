<?php

class RequestTest extends PHPUnit_Framework_TestCase{

	private $req;

	public function setUp(){
		$this->req = new \Tempest\Routing\Request('T1','action',array('id' => 3, 'name' => 'tempest'));
	}

	public function testSimple(){
		$this->assertEquals('T1',$this->req->class);
		$this->assertEquals('action',$this->req->action);
		$this->assertEquals(3,$this->req->params['id']);
		$this->assertEquals('tempest',$this->req->params['name']);
	}

}