<?php namespace Trial\Routing;

use Trial\Injection\Container;

use Trial\Routing\Http\Input,
	Trial\Routing\Http\Request;

class Factory {
	
	public function __construct (Container $container) {
		$this->container = $container;
	}
	
	public function request ($url, $input) {
		return new Request($url, $input);
	}
	
	public function input () {
		return new Input(
			[
				'get' => $_GET,
				'post' => $_POST,
				'server' => $_SERVER
			], 
			getallheaders()
		);
	}
	
	public function router ($routes) {
		return new Router($routes);
	}
	
	public function dispatcher () {
		return new Dispatcher($this->container);
	}
	
	public function urlBuilder ($input, $routes) {
		return new UrlBuilder($input, $routes);
	}
	
}