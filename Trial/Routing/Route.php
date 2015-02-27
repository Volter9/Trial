<?php namespace Trial\Routing;

use Closure;

use Trial\Routing\Http\Request;

use Trial\Routing\Route\Action,
	Trial\Routing\Route\Actions\Controller,
	Trial\Routing\Route\Actions\Callback,
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
	
	/**
	 * @param string $url
	 * @param string $controller
	 * @return \Trial\Routing\Route
	 */
	static public function fromUrl ($url, $controller) {
		$url    = Url::fromString($url);
		$action = Controller::fromString($controller);
		
		return new Route($url, $action, new Parameters($url));
	}
	
	/**
	 * @param string $url
	 * @param \Closure $callback
	 * @return \Trial\Routing\Route
	 */
	static public function withCallback ($url, Closure $callback) {
		$url    = Url::fromString($url);
		$action = new Callback($callback);
		
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
	 * @return \Trial\Routing\Route\Url
	 */
	public function getUrl () {
		return $this->url;
	}
	
	/**
	 * @return \Trial\Routing\Route\Action
	 */
	public function getAction () {
		return $this->action;
	}
	
	/**
	 * Matches the route based on request
	 * 
	 * @param \Trial\Routing\Http\Request
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