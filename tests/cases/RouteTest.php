<?php
/**
 * Route test
 * testCase of Tempest\Routing\Route
 *
 * @package Tempest
 * @author Michal Haták [Twista] <me@twista.cz>
 **/

class RouteTest extends PHPUnit_Framework_TestCase {

	public $route;

    public function setUp(){
        $this->route = new \Tempest\Routing\Route();
    }

    public function testGettersSetters(){
    	$r = $this->route;
    	$r->setUrl('post/all');
    	$this->assertEquals(BASE_PATH.'post/all/', $r->getUrl());

    	$r->setTarget('PostController:showPost');
    	$this->assertEquals('PostController:showPost',$r->getTarget());

    }

    public function testRegexp(){
    	$r = $this->route;
    	$r->setUrl('post/show/:id');
    	$r->setTarget('MyTarget:fake');

    	$this->assertEquals(1,preg_match("@^" . $r->getRegex() . "*$@i", BASE_PATH.'post/show/1'),'test regexpu cislo 1');
    	$this->assertEquals(1,preg_match("@^" . $r->getRegex() . "*$@i", BASE_PATH.'post/show/11'),'test regexpu cislo 2');
    	$this->assertEquals(1,preg_match("@^" . $r->getRegex() . "*$@i", BASE_PATH.'post/show/obcdef'),'test regexpu cislo 3');

    	$this->assertEquals(0,preg_match("@^" . $r->getRegex() . "*$@i", BASE_PATH.'posty/show/obcdef'),'test regexpu cislo 4');
    	$this->assertEquals(0,preg_match("@^" . $r->getRegex() . "*$@i", BASE_PATH.'/post/show/1'),'test regexpu cislo 5');
    }

	public function tearDown() {
        // your code here
    }
}
