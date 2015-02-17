<?php namespace Trial\Routing;

use Trial\Injection\Container,
	Trial\Routing\Http\Request;

class Router {
	
	private $config;
	private $container;
	
	private $routes;
	private $base;
	
	public function __construct (Container $container, Routes $routes) {
		$this->container = $container;
		$this->routes = $routes;
		$this->config = $container->get('config.routing');
	}
	
	public function add ($url, $controller, $id = '') {
		$this->routes->add(Route::fromUrl($url, $controller), $id);
	}
	
	public function setErrorRoute($url, $controller) {
		$this->errorRoute = Route::fromUrl($url, $controller);
	}
	
	public function urlTo ($id, array $params = []) {
		$route = $this->routes->getById($id);
		$url = $route ? $route->url($params) : '';
		
		return $this->base . $url;
	}
	
	public function route (Request $request) {
		$request->setBase($this->getBase($request));
		$route = $this->routes->match($request);
		
		return $route ?: $this->errorRoute;
	}
	
	/**
	 * @todo not your responsibility
	 */
	private function getBase (Request $request) {
		if (!$this->base) {
			$root = $request->getInput()->getServer('DOCUMENT_ROOT');
			$fragments = explode($root, BASE_PATH);
			
			$this->base = '/' . trim(end($fragments), '/');
		}
		
		return $this->base;
	}
	
}