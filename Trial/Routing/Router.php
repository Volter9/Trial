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
		$request->setBase($this->getBase($request));
		
		$route = $this->routes->match($request);
		
		if ($route) {
			return $route;
		}
		
		throw new Exception('Not found');
	}
	
	/**
	 * @todo "not your responsibility"
	 */
	private function getBase (Request $request) {
		if (!$this->base) {
			$root = $request->getInput()->get('server', 'DOCUMENT_ROOT');
			$fragments = explode($root, BASE_PATH);
			
			$this->base = '/' . trim(end($fragments), '/');
		}
		
		return $this->base;
	}
	
}