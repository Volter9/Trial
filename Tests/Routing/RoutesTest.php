<?php namespace Tests\Routing;

use Trial\Routing\Routes;

/**
 * @coversDefaultClass \Trial\Routing\Routes
 */
class RoutesTest extends \PHPUnit_Framework_TestCase {
	
	/**
	 * @covers ::__construct
	 * @covers ::add
	 * @covers ::getById
	 */
	public function testRoutesShouldGetById () {
		$routes = new Routes;
		
		$home = $this->getMockBuilder('\Trial\Routing\Route')
			->disableOriginalConstructor()
			->getMock();
			
		$routes->add('home', $home);
		
		$this->assertEquals($routes->getById('home'), $home);
	}
	
	/**
	 * @covers ::getById
	 */
	public function testRoutesShouldFailGetById () {
		$routes = new Routes;
		
		$this->assertFalse($routes->getById('foo'));
	}
	
	/**
	 * @covers ::add
	 * @covers ::match
	 */
	public function testRoutesShouldMatchRequest () {
		$routes = new Routes;
		
		$request = $this->getMockBuilder('\Trial\Routing\Http\Request')
			->disableOriginalConstructor()
			->getMock();
		
		$home = $this->getMockBuilder('\Trial\Routing\Route')
			->disableOriginalConstructor()
			->getMock();
		
		$home->method('match')->willReturn(true);
		
		$routes->add('home', $home);
		
		$this->assertEquals($routes->match($request), $home);
	}
	
	/**
	 * @covers ::match
	 */
	public function testRoutesShouldFailMatchRequest () {
		$routes = new Routes;
		
		$request = $this->getMockBuilder('\Trial\Routing\Http\Request')
			->disableOriginalConstructor()
			->getMock();
		
		$this->assertFalse($routes->match($request));
	}
	
}