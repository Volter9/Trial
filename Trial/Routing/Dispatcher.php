<?php namespace Trial\Routing;

use Trial\Injection\Container,
	Trial\Routing\Http\Request,
	Trial\Routing\Http\Response;

/**
 * Dispatcher class
 * 
 * Dispatches and executes the request
 * 
 * @package Trial
 */

class Dispatcher {
	
	/**
	 * @var \Trial\Injection\Container
	 */
	private $container;
		
	/**
	 * Constructor
	 * 
	 * @param \Trial\Injection\Container $container
	 */
	public function __construct (Container $container) {
		$this->container = $container;
	}
	
	/**
	 * Dispatch the request
	 * 
	 * @param \Trial\Routing\Http\Request $route
	 * @param \Trial\Routing\Http\Response $request
	 */
	public function dispatch (Route $route, Request $request) {
		list ($controller, $action) = $route->getController();
		
		$request->setParameters($route->getParameters($request));
		$response = new Response;
		
		$body = (new $controller($this->container))->$action($request, $response);
		$body and $response->setBody($body);
		
		return $response;
	}
	
}