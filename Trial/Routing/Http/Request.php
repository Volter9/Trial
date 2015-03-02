<?php namespace Trial\Routing\Http;

use Trial\Routing\Route,
	Trial\Routing\Route\Url;

class Request {
	
	private $input;
	private $url;
	
	/**
	 * @var \Trial\Routing\Route\Parameters
	 */
	private $parameters;
	
	/**
	 * @var \Trial\Routing\Route
	 */
	private $route;
	
	/**
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
	
	public function getRoute () {
		return $this->route;
	}
	
	public function setRoute (Route $route) {
		$this->route = $route;
		$this->parameters = $route->getParameters($this);
	}
	
	public function get ($key) {
		return $this->parameters->get($key);
	}
	
}