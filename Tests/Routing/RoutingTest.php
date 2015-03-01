<?php namespace Tests\Routing;

use Trial\Injection\Container;

use Trial\Routing\Dispatcher,
	Trial\Routing\Factory,
	Trial\Routing\Routes,
	Trial\Routing\Router,
	Trial\Routing\Route,
	Trial\Routing\UrlBuilder;

use Trial\Routing\Http\Input,
	Trial\Routing\Http\Request;

use Trial\Routing\Route\Url;

class RoutingTest extends \PHPUnit_Framework_TestCase {
	
	public function createRoutes () {
		$self = $this;
		
		$routes = new Routes;
		$routes->add('home', Route::fromUrl('/', '\App\Controllers\Index'));
		$routes->add('page', 
			Route::withCallback('/page/@page', function () use ($self) {
				$self->assertTrue(true);
			})
		);
		
		return $routes;
	}
	
	public function testDispatching () {
		$routes = $this->createRoutes();
		$router = new Router($routes);
		
		$request = new Request(
			new Url('GET', '/page/1'), 
			new Input
		);
		
		$route = $router->route($request);
		
		$dispatcher = new Dispatcher;
		$dispatcher->dispatch(new Container, $route, $request);
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
		define('BASE_PATH', '');
		
		$router = new Router($routes);
		$input = new Input;
		
		$request = new Request(
			new Url('GET', '/page/1'), 
			$input
		);
		
		$route = $router->route($request);
		
		$this->assertEquals($route, $routes->getById('page'));
		
		return new UrlBuilder($input, $routes);
	}
	
	/**
	 * @depends testRouterMatch
	 */
	public function testUrlBuilder ($builder) {
		$this->assertEquals($builder->urlToRoute('home'), '/');
		$this->assertEquals($builder->urlToRoute('page', [1]), '/page/1');
		$this->assertEquals($builder->url('assets/css/main.css'), '/assets/css/main.css');
	}
	
}