<?php namespace Trial\Routing;

use Trial\Routing\Http\Request;

use Trial\Routing\Route\Action,
	Trial\Routing\Route\Parameters,
	Trial\Routing\Route\Url;

/**
 * Route class
 * 
 * @package Trial
 */

class Route {
	
	/**
	 * @var \Trial\Routing\Route\Url
	 */
	private $url;
	
	/**
	 * @var \Trial\Routing\Route\Action
	 */
	private $action;
	
	/**
	 * @var \Trial\Routing\Route\Parameters
	 */
	private $parameters;
	
	static public function fromUrl ($url, $controller) {
		$url    = Url::fromString($url);
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
	
	/**
	 * Returns representation of controller (class and method) 
	 * in indexed array.
	 * 
	 * @return array
	 */
	public function getController () {
		return $this->action->toArray();
	}
	
	/**
	 * Matches the route based on request
	 * 
	 * @return bool
	 */
	public function match (Request $request) {	
		return $this->action->exists() 
			&& $this->url->match($request->getUrl());
	}
	
	/**
	 * @todo remove confusion of getUrl()->getUrl()
	 * 
	 * @param \Trial\Routing\Http\Request $request
	 * @return \Trial\Routing\Route\Parameters
	 */
	public function getParameters (Request $request) {
		$this->parameters->parseParameters($request->getUrl()->getUrl());
		
		return $this->parameters;
	}
	
	/**
	 * Get a url of route with applied given parameters
	 * 
	 * @param array $params
	 * @return string
	 */
	public function url (array $params) {
		return $this->parameters->apply($params);
	}
	
}