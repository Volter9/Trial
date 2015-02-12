<?php namespace Trial\Routing;

use Trial\Routing\Http\Request;

use Trial\Routing\Route\Action,
	Trial\Routing\Route\Parameters,
	Trial\Routing\Route\Url;


class Route {
	
	private $url;
	private $action;
	private $parameters;
	
	private $id;
	
	private $pattern;
	
	private $symbolPattern = '/@([\w\d-_]+)/';
	private $anyPattern = '([\w\d-_]+)';
	
	static public function fromUrl ($url, $controller, $id = '') {
		list($method, $url) = explode(' ', $url);
		list($controller, $action) = static::parseAction($controller);
		
		$url = new Url($method, $url);
		$action = new Action($controller, $action);
		
		return new Route($url, $action, $id);
	}
	
	static private function parseAction ($controller) {
		$action = 'index';
		
		if (strpos($controller, '::') !== false) {
			list ($controller, $action) = explode('::', $controller);
		}
		
		return [$controller, $action];
	}
	
	/**
	 * Route's constructor
	 * 
	 * @param \Trial\Routing\Route\Url $url
	 * @param \Trial\Routing\Route\Action $action
	 * @param string $id
	 */
	public function __construct (Url $url, Action $action, $id) {
		$this->url = $url;
		$this->action = $action;
		$this->id = $id;
		
		$this->pattern = $this->compilePattern($url->getUrl());
		$this->url->setPattern($this->pattern);
		// Hahaha
		$this->parameters = new Parameters($url);
	}
	
	private function compilePattern ($url) {
		$url = preg_replace($this->symbolPattern, $this->anyPattern, $url);
		
		return "#^$url$#i";
	}
	
	public function getController () {
		return $this->action->toArray();
	}
	
	public function getId () {
		return $this->id;
	}
	
	public function match (Request $request) {
		return $this->action->exists() 
			&& $this->url->match($request->getUrl());
	}
	
	public function getParameters (Request $request) {
		// WTF? getUrl()->getUrl()
		$this->parameters->parseParameters($request->getUrl()->getUrl());
		
		return $this->parameters;
	}
	
	public function url (array $params) {
		return $this->parameters->apply($params);
	}
	
}