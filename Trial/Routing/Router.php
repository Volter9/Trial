<?php namespace Trial\Routing;

use Trial\Injection\Container,
	Trial\Routing\Http\Request;

class Router {
	
	private $config;
	private $container;
	
	private $errorRoute;
	private $routes;
	
	public function __construct (Container $container, Routes $routes) {
		$this->container = $container;
		$this->routes = $routes;
		$this->config = $container->get('config.routing');
	}
	
	public function add ($url, $controller, $id = '') {
		$this->routes->add(
			Route::fromUrl($url, $controller, $id)
		);
	}
	
	public function setErrorRoute($url, $controller) {
		if ($this->errorRoute) {
			throw new Exception (
				'Cannot set error controller again'
			);
		}
		
		$this->errorRoute = Route::fromUrl($url, $controller);
	}
	
	public function urlTo ($id, array $params = []) {
		$route = $this->routes->getById($id);
		
		if (!$route) {
			return '';
		}
		
		return $route->url($id, $params);
	}
	
	public function route (Request $request) {
		$route = $this->routes->match($request);
		
		if (!$route) {
			$route = $this->errorRoute;
		}
		
		return $route;
	}
	
}