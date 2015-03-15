<?php namespace Trial\Routing;

use Closure;

use Trial\Routing\Route,
	Trial\Routing\Routes;

use Trial\Routing\Route\Actions\Callback,
	Trial\Routing\Route\Actions\Controller;

use Trial\Routing\Route\Parameters,
	Trial\Routing\Route\Url;

class RoutesFactory {
	
	private $routes;
	
	public function __construct (Routes $routes) {
		$this->routes = $routes;
	}
	
	public function callback ($id, $url, Closure $callback) {
		$url = $this->createUrl($url);
		$action = new Callback($callback);
		
		$this->routes->add($id, $this->createRoute($url, $action));
	}
	
	public function controller ($id, $url, $controller) {
		$url = $this->createUrl($url);
		$action = $this->createController($controller);
		
		$this->routes->add($id, $this->createRoute($url, $action));
	}
	
	private function createRoute ($url, $action) {
		return new Route($url, $action, new Parameters($url));
	}
	
	private function createUrl ($url) {
		$token = ' ';
		
		if (!strpos($url, $token)) {
			$url = "* $url";
		}
		
		list($method, $url) = explode($token, $url);
		
		return new Url($method, $url);
	}
	
	private function createController ($controller) {
		$token = '::';
		
		if (!strpos($controller, $token)) {
			$controller = "$controller::index";
		}
		
		list($controller, $action) = explode($token, $controller);
		
		return new Controller($controller, $action);
	}
	
	public function import (array $config) {
		foreach ($config as $id => $route) {
			if (!isset($route['method'])) {
				$route['method'] = '*';
			}
			
			$path   = $route['path'];
			$method = $route['method'];
			
			$url = new Url($method, $path);
			$action = $this->createAction($route);
			
			$this->routes->add($id, $this->createRoute($url, $action));
		}
	}
	
	protected function createAction (array $route) {
		if (isset($route['controller'])) {
			return $this->createController($route['controller']);
		}
		else if (isset($route['callback'])) {
			return new Callback($route['callback']);
		}
		
		throw new Exception('Action could not be created in RoutesFactory!!!');
	}
	
}