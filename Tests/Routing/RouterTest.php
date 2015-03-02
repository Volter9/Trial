<?php namespace Tests\Routing;

use Trial\Routing\Router;

/**
 * @coversDefaultClass \Trial\Routing\Router
 */
class RouterTest extends \PHPUnit_Framework_TestCase {
	
	/**
	 * @covers ::__construct
	 * @covers ::route
	 */
	public function testRouterShouldRouting () {
		$request = $this->getMockBuilder('\Trial\Routing\Http\Request')
			->disableOriginalConstructor()
			->getMock();
		
		$route = $this->getMockBuilder('\Trial\Routing\Route')
			->disableOriginalConstructor()
			->getMock();
		
		$route->method('match')->willReturn(true);
		
		$routes = $this->getMockBuilder('\Trial\Routing\Routes')
			->setConstructorArgs([
				['home' => $route]
			])
			->getMock();
		
		$routes->method('match')->willReturn($route);
		
		$router = new Router($routes);
		$this->assertEquals($router->route($request), $route);
	}
	
	/**
	 * @covers ::route
	 * @expectedException \Exception
	 */
	public function testRouterShouldFailRouting () {
		$request = $this->getMockBuilder('\Trial\Routing\Http\Request')
			->disableOriginalConstructor()
			->getMock();
		
		$routes = $this->getMockBuilder('\Trial\Routing\Routes')
			->getMock();
		
		$router = new Router($routes);
		$router->route($request);
	}
	
}