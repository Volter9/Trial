<?php namespace Trial\Routing;

use Trial\Helpers\UrlParsing;

use Trial\Routing\Route\Url;

use Trial\Routing\Http\Input;

class UrlBuilder {
	
	private $input;
	private $routes;
	
	private $base;
	
	public function __construct (Input $input, Routes $routes, $basePath) {
		$this->input = $input;
		$this->routes = $routes;
		
		$this->base = $this->getBase($basePath);
	}
	
	private function getBase ($basePath) {
		$root = $this->input->server('DOCUMENT_ROOT');
		$root = strlen($root ?: $basePath);
		
		$url = substr($basePath, $root);
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