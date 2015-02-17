<?php namespace Trial\Routing;

use Trial\Routing\Http\Request;

use Trial\Routing\Route\Action,
	Trial\Routing\Route\Parameters,
	Trial\Routing\Route\Url;

class Route {
	
	private $url;
	private $action;
	private $parameters;
	
	static public function fromUrl ($url, $controller) {
		$url = Url::fromString($url);
		$action = Action::fromString($controller);
		
		return new Route($url, $action, new Parameters($url));
	}
	
	/**
	 * Route's constructor
	 * 
	 * @param \Trial\Routing\Route\Url $url
	 * @param \Trial\Routing\Route\Action $action
	 * @param \Trial\Routing\Route\Parameters $parameters
	 */
	public function __construct (
		Url $url, 
		Action $action, 
		Parameters $parameters
	) {
		$this->url = $url;
		$this->action = $action;
		$this->parameters = $parameters;
	}
	
	public function getController () {
		return $this->action->toArray();
	}
	
	public function match (Request $request) {	
		return $this->action->exists() 
			&& $this->url->match($request->getUrl());
	}
	
	/**
	 * @todo remove confusion of getUrl()->getUrl()
	 */
	public function getParameters (Request $request) {
		$this->parameters->parseParameters($request->getUrl()->getUrl());
		
		return $this->parameters;
	}
	
	public function url (array $params) {
		return $this->parameters->apply($params);
	}
	
}