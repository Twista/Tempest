<?php
/**
 * Router test
 * testCase of Tempest\Routing\Router
 *
 * @package Tempest
 * @author Michal Haták [Twista] <me@twista.cz>
 **/

class RouterTest extends PHPUnit_Framework_TestCase{

	public $routes;

	public $router;

    public function setUp(){
    	// setup default routes for testCase
        $routes = array(
			'posts'                 => 'Post:showAll',
			'post/[id]'              => 'Post:showOne',
            'post/[year]/[month]/[id]' => 'Post:showByDates',
			'[controller]/[action]' => '[controller]:[action]',
			'archiv'                => 'Archiv:short',
			'archiv.html'           => 'Archiv:long',
			);
        $this->routes = $routes;
    }

    public function testTypes(){

    }

    public function testMatches(){
    	$reflection_class = new ReflectionClass('\Tempest\Routing\Router');

        $method = $reflection_class->getMethod("match");
        $method->setAccessible(true);

        $r = new \Tempest\Routing\Router($this->routes);
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '';
        $res = $method->invoke($r);
        $this->assertEquals('Post:showAll',$res->getTarget(),'Defaultni parametr');

        $_SERVER['REQUEST_URI'] = BASE_PATH.'post/1'; // post/:id
        $res = $method->invoke($r);
        $this->assertEquals('Post:showOne',$res->getTarget());

        $_SERVER['REQUEST_URI'] = 'post/12433'; // post/:id
        $res = $method->invoke($r);
        $this->assertEquals('Post:showOne',$res->getTarget());

        $_SERVER['REQUEST_URI'] = 'post/123/1/1'; // post/:year/:month/:id
        $res = $method->invoke($r);
        $this->assertEquals('Post:showByDates',$res->getTarget());

        $_SERVER['REQUEST_URI'] = 'archiv';
        $res = $method->invoke($r);
        $this->assertEquals('Archiv:short',$res->getTarget());

        $_SERVER['REQUEST_URI'] = 'archiv.html';
        $res = $method->invoke($r);
        $this->assertEquals('Archiv:long',$res->getTarget());
    }

    /**
 	* @expectedException Exception
 	*/
    public function testExceptions(){
    	$reflection_class = new ReflectionClass('\Tempest\Routing\Router');

        $method = $reflection_class->getMethod("match");
        $method->setAccessible(true);

        $r = new \Tempest\Routing\Router();
        $this->setExpectedException('Exception');
        $method->invoke($r,'match');
    }

    public function tearDown(){
        // your code here
    }
}
