<?php namespace Trial\Routing;

use Trial\Injection\Container,
	Trial\Routing\Http\Request,
	Trial\Routing\Http\Response;

class Dispatcher {
	
	public function __construct (Container $container) {
		$this->container = $container;
	}
	
	public function dispatch (Route $route, Request $request) {
		list ($controller, $action) = $route->getController();
		
		$request->setParameters($route->getParameters($request));
		$response = new Response;
		
		$this->container->set('route', $route);
		
		$body = (new $controller($this->container))->$action($request, $response);
		$body and $response->setBody($body);
		
		return $response;
	}
	
}