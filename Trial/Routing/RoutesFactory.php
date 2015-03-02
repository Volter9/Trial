<?php namespace Trial\Routing;

use Closure;

use Trial\Routing\Route;

use Trial\Routing\Route\Actions\Callback,
	Trial\Routing\Route\Actions\Controller;

use Trial\Routing\Route\Parameters,
	Trial\Routing\Route\Url;

class RoutesFactory {
	
	public function callback ($url, Closure $callback) {
		$url = $this->createUrl($url);
		$action = new Callback($callback);
		
		return $this->createRoute($url, $action);
	}
	
	public function controller ($url, $controller) {
		$url = $this->createUrl($url);
		$action = $this->createController($controller);
		
		return $this->createRoute($url, $action);
	}
	
	private function createRoute ($url, $action) {
		return new Route($url, $action, new Parameters($url));
	}
	
	private function createUrl ($url) {
		$token = ' ';
		$url = !strpos($url, $token) ? "* $url" : $url;
		
		list($method, $url) = explode($token, $url);
		
		return new Url($method, $url);
	}
	
	private function createController ($controller) {
		$token = '::';
		$controller = !strpos($controller, $token) ? "$controller::index" : $controller;
		
		list($controller, $action) = explode($token, $controller);
		
		return new Controller($controller, $action);
	}
	
}