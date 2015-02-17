<?php namespace Tests;

use Trial\Routing\Router,
	Trial\Routing\Routes;

class RoutingTest extends \PHPUnit_Framework_TestCase {
	
	public function testCreate () {
		$router = new Router(new Routes);
	}
	
}