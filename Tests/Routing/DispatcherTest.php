<?php namespace Tests\Routing;

use Trial\Routing\Dispatcher;

/**
 * @coversDefaultClass \Trial\Routing\Dispatcher
 */
class DispatcherTest extends \PHPUnit_Framework_TestCase {
	
	/**
	 * @covers ::dispatch
	 */
	public function testDispatcherShouldReturnResponse () {
		$container = $this->getMock('\Trial\Injection\Container');
		$route = $this->getMockBuilder('\Trial\Routing\Route')
			->disableOriginalConstructor()
			->getMock();
		
		$route->method('getAction')
			->willReturn($action);
		
		$request = $this->getMockBuilder('\Trial\Routing\Http\Request')
			->disableOriginalConstructor()
			->getMock();
		
		$action = $this->getMockBuilder('\Trial\Routing\Route\Action')
			->getMock();
			
		$action->method('invoke')
			->willReturn('foostring');
		
		$dispatcher = new Dispatcher;
		$response = $dispatcher->dispatch($container, $route, $request);
		
		$this->assertInstanceOf('\Trial\Routing\Http\Response', $response);
	}
	
}