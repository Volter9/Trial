<?php namespace Trial\Routing;

use Exception;

use Trial\Injection\Container,
	Trial\Routing\Http\Request;

class Router {
	
	private $config;
	private $container;
	
	private $routes;
	private $base;
	
	public function __construct (Routes $routes) {
		$this->routes = $routes;
	}
	
	public function route (Request $request) {	
		$route = $this->routes->match($request);
		
		if ($route) {
			return $route;
		}
		
		throw new Exception('Not Found');
	}
	
}