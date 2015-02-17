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
		
		$this->base = $this->resolveBase();
	}
	
	private function resolveBase () {
		$root = $this->input->get('server', 'DOCUMENT_ROOT');
		$fragments = explode($root, BASE_PATH);
		
		return '/' . trim(end($fragments), '/');
	}
	
	public function getBase () {
		return $this->base;
	}
	
	public function urlTo ($id, array $params) {
		$route = $this->routes->getById($id);
		$url = $route ? $route->url($params) : '';
		
		return $this->base . $url;
	}
	
	public function requestUrl () {
		$input = $this->input;	
		
		$url = $input->get('server', 'REQUEST_URI');
		$url = parse_url($url, PHP_URL_PATH);
		$url = chop($url, '/');
		
		$url = new Url($input->get('server', 'REQUEST_METHOD'), $url);
		$url->setBase($this->base);
		
		return $url;
	}
	
}