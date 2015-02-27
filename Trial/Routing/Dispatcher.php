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
	 * Dispatch the request
	 * 
	 * @param \Trial\Routing\Http\Request $route
	 * @param \Trial\Routing\Http\Response $request
	 */
	public function dispatch (
		Container $container, 
		Route $route, 
		Request $request
	) {
		$action = $route->getAction();
		
		$parameters = $route->getParameters($request);
		$response = new Response;
		
		$request->setParameters($parameters);
		
		if ($body = $action->invoke($container, $request, $response)) {
			$response->setBody($body);
		}
		
		return $response;
	}
	
}