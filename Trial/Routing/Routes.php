<?php namespace Trial\Routing;

use Trial\Routing\Http\Request;

class Routes {
	
	private $routes = [];
	
	public function __construct (array $routes = []) {
		$this->routes = $routes;
	}
	
	public function add ($route) {
		if ($id = $route->getId()) {
			$this->routes[$id] = $route;
		}
		else {
			$this->routes[] = $route;
		}
	}
	
	public function getById ($id) {
		if (!isset($this->routes[$id])) {
			return false;
		}
		
		return $this->routes[$id];
	}
	
	public function match (Request $request) {
		foreach ($this->routes as $route) {
			if ($route->match($request)) {
				return $route;
			}
		}
		
		return false;
	}
	
}