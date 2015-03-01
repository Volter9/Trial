<?php namespace Trial\Routing;

use Trial\Helpers\UrlParsing;

use Trial\Routing\Route\Url,
	Trial\Routing\Http\Input;

class UrlBuilder {
	
	private $input;
	private $routes;
	
	private $base;
	
	public function __construct (Input $input, Routes $routes) {
		$this->input = $input;
		$this->routes = $routes;
		
		$this->base = $this->getBase();
	}
	
	private function getBase () {
		$root = $this->input->server('DOCUMENT_ROOT');
		$root = strlen($root ?: BASE_PATH);
		
		$url = substr(BASE_PATH, $root);
		$url = trim($url, '/');
		
		return "/$url";
	}
	
	public function urlToRoute ($id, array $params = []) {
		if (!$route = $this->routes->getById($id)) {
			return '';
		}
		
		return $this->url($route->url($params));
	}
	
	public function url ($path) {
		return UrlParsing::trimSlashes("{$this->base}$path");
	}
	
	public function requestUrl () {
		$url    = $this->input->server('REQUEST_URI');
		$method = $this->input->server('REQUEST_METHOD');
		
		$path = parse_url($url, PHP_URL_PATH);
		
		if (
			$this->base !== '' && 
			$this->base !== '/'
		) {
			$path = substr($path, strlen($this->base));
		}
		
		return new Url($method, $path);
	}
	
}