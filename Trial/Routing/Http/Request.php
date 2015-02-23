<?php namespace Trial\Routing\Http;

use Trial\Routing\Route\Parameters,
	Trial\Routing\Route\Url;

class Request {
	
	private $input;
	private $url;
	
	private $parameters;
	
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
	
	public function getUrl () {
		return $this->url;
	}
	
	public function getInput () {
		return $this->input;
	}
	
	public function getParameters () {
		return $this->parameters;
	}
	
	public function setParameters (Parameters $parameters) {
		$this->parameters = $parameters;
	}
	
}