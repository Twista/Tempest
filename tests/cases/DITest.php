<?php

class DITest extends PHPUnit_Framework_TestCase{

	private $di;

	public function setUp(){
		$this->di = new \Tempest\DI\Container();
	}

	public function testGetSetServices(){

		$class = new stdClass();
		$this->di->set('Test1',$class);
		$this->assertInstanceOf('stdClass',$this->di->get('Test1'),'Test 1');

		$this->di->set('Test2', function (){
			return new StdClass();
		});
		$this->assertInstanceOf('stdClass',$this->di->get('Test2'),'Test 2 - handling closure object');

		$this->di->set('Test3','stdClass');
		$this->assertInstanceOf('stdClass',$this->di->get('Test3'),'Test 3');
	}

}