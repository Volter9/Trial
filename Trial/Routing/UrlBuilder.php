<?php namespace Trial\Routing;

use Trial\Routing\Route\Url;

use Trial\Routing\Http\Input;

class UrlBuilder {
	
	private $input;
	private $routes;
	
	private $base;
	
	public function __construct (Input $input, Routes $routes) {
		$this->input = $input;
		$this->routes = $routes;
		
		$this->base = $this->base();
	}
	
	private function base () {
		$root = $this->input->server('DOCUMENT_ROOT');
		$root = $root !== '' ? $root : BASE_PATH;
		
		return '/' . trim(substr(BASE_PATH, strlen($root)), '/');
	}
	
	public function urlToRoute ($id, array $params) {
		if (!$route = $this->routes->getById($id)) {
			return '';
		}
		
		return $this->base . $route->url($params);
	}
	
	public function url ($path) {
		return $this->base . $path;
	}
	
	public function requestUrl () {
		$input = $this->input;	
		$url = $input->server('REQUEST_URI');
		
		$path = parse_url($url, PHP_URL_PATH);
		$path = str_replace($this->base, '', $path);
		
		return new Url($input->server('REQUEST_METHOD'), $path);
	}
	
}