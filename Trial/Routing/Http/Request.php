<?php namespace Trial\Routing\Http;

use Trial\Routing\Route\Url;

class Request {
	
	private $input;
	private $url;
	private $parameters;
		
	static public function fromUrl () {
		return new Request(static::getRequestPath());
	}
	
	static protected function getRequestPath () {
		$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$url = chop($url, '/');
	
		return $url;
	}
	
	public function __construct ($url) {
		// Hahaha
		$this->input = new Input;
		$this->url = new Url(
			$this->input->getServer('REQUEST_METHOD'), $url
		);
		
		$this->url->setBase($this->findBase());
	}
	
	private function findBase () {
		$base = BASE_PATH;
		$root = $this->input->getServer('DOCUMENT_ROOT');
		$fragments = explode($root, $base);
		
		return '/' . trim(end($fragments), '/');
	}
	
	public function getUrl () {
		return $this->url->getUrl();
	}
	
	public function getMethod () {
		return $this->url->getMethod();
	}
	
	public function setParameters (array $parameters) {
		$this->parameters = $parameters;
	}
	
	public function getParameter ($key) {
		if (!isset($this->parameters[$key])) {
			return false;
		}
		
		return $this->parameters[$key];
	}
	
	public function isPost () {
		return $this->method === 'POST';
	}
	
	public function getInput () {
		return $this->input;
	}
	
}