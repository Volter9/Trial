<?php namespace Tests\Routing;

use Trial\Routing\Factory,
	Trial\Routing\Routes,
	Trial\Routing\Router,
	Trial\Routing\Route;

use Trial\Routing\Http\Input,
	Trial\Routing\Http\Request;

use Trial\Routing\Route\Url;

class RoutingTest extends \PHPUnit_Framework_TestCase {
	
	public function createRoutes () {
		$routes = new Routes;
		$routes->add('home', Route::fromUrl('/', '\App\Controllers\Index'));
		$routes->add('page', Route::fromUrl('/page/@page', '\App\Controllers\Index'));
		
		return $routes;
	}
	
	public function testRoutesFind () {
		$routes = $this->createRoutes();
		$route = $routes->getById('home');
		
		$this->assertEquals($route->getUrl()->getUrl(), '/');
		
		return $routes;
	}
	
	/**
	 * @depends testRoutesFind
	 */
	public function testRouterMatch ($routes) {
		$url = new Url('GET', '/page/1');
		$input = new Input;
		
		$request = new Request($url, $input);
		$router = new Router($routes);
		
		$route = $router->route($request);
		
		$this->assertEquals($route, $routes->getById('page'));
	}
	
}