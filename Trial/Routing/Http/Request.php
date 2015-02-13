<?php namespace Trial\Routing\Http;

use Trial\Routing\Route\Parameters,
	Trial\Routing\Route\Url;

class Request {
	
	private $input;
	
	private $parameters;
	private $url;
	
	static public function fromUrl () {
		$input = new Input;
		
		$url = new Url(
			$input->getServer('REQUEST_METHOD'), 
			static::getRequestPath()
		);
		
		return new Request($url, $input);
	}
	
	static protected function getRequestPath () {
		$url = $_SERVER['REQUEST_URI'];
		$url = parse_url($url, PHP_URL_PATH);
	
		return chop($url, '/');
	}
	
	/**
	 * Constructor
	 * 
	 * @param \Trial\Routing\Route\Url $url
	 * @param \Trial\Routing\Http\Input
	 */
	public function __construct (Url $url, Input $input) {
		$this->input = $input;
		$this->url = $url;
		
		$this->url->setBase($this->findBase());
	}
	
	private function findBase () {
		$root = $this->input->getServer('DOCUMENT_ROOT');
		$fragments = explode($root, BASE_PATH);
		
		return '/' . trim(end($fragments), '/');
	}
	
	public function getUrl () {
		return $this->url;
	}
	
	public function setParameters (Parameters $parameters) {
		$this->parameters = $parameters;
	}
	
	public function getParameters () {
		return $this->parameters;
	}
	
	public function getInput () {
		return $this->input;
	}
	
}