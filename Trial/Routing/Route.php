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
	
	static public function fromUrl ($url, $controller, $id = '') {
		$url        = Url::fromString($url);
		$action     = Action::fromString($controller);
		$parameters = new Parameters($url);
		
		return new Route($url, $action, $parameters, $id);
	}	
	/**
	 * Route's constructor
	 * 
	 * @param \Trial\Routing\Route\Url $url
	 * @param \Trial\Routing\Route\Action $action
	 * @param \Trial\Routing\Route\Parameters $parameters
	 * @param string $id
	 */
	public function __construct (
		Url $url, 
		Action $action, 
		Parameters $parameters, 
		$id
	) {
		$this->url = $url;
		$this->action = $action;
		$this->parameters = $parameters;
		$this->id = $id;
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
		// @todo rename method to avoid getUrl()->getUrl()
		$this->parameters->parseParameters($request->getUrl()->getUrl());
		
		return $this->parameters;
	}
	
	public function url (array $params) {
		return $this->parameters->apply($params);
	}
	
}