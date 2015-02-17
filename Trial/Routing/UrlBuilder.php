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
		$root = $this->input->get('server', 'DOCUMENT_ROOT');
		$fragments = explode($root, BASE_PATH);
		
		return rtrim(end($fragments), '/');
	}
	
	public function urlToRoute ($id, array $params) {
		if (!$route = $this->routes->getById($id)) {
			return '';
		}
		
		return $this->base . $route->url($params);
	}
	
	public function url ($path) {
		return "/{$this->base}$path";
	}
	
	public function requestUrl () {
		$input = $this->input;	
		
		$url = $input->get('server', 'REQUEST_URI');
		$url = parse_url($url, PHP_URL_PATH);
		$url = str_replace($this->base, '', $url);
		
		return new Url($input->get('server', 'REQUEST_METHOD'), $url);
	}
	
}