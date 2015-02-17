<?php namespace Trial\Routing\Http;

use Trial\Routing\Route\Parameters,
	Trial\Routing\Route\Url;

class Request {
	
	private $input;
	
	private $parameters;
	private $url;
	
	static public function withInput (Input $input) {
		$url = new Url(
			$input->get('server', 'request_method'), 
			static::getRequestPath($input)
		);
		
		return new Request($url, $input);
	}
	
	static protected function getRequestPath (Input $input) {
		$url = $input->get('server', 'request_uri');
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
	}
	
	public function setBase ($base) {
		$this->url->setBase($base);
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