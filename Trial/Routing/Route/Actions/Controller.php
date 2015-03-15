<?php namespace Trial\Routing\Route\Actions;

use Trial\Injection\Container;

use Trial\Routing\Route\Action;

use Trial\Routing\Http\Request,
	Trial\Routing\Http\Response;

class Controller implements Action {
	
	private $controller;
	private $action;
	
	public function __construct ($controller, $action) {
		$this->controller = $controller;
		$this->action = $action;
	}
	
	public function getAction () {
		return "{$this->action}Action";
	}
	
	public function exists () {
		return class_exists($this->controller)
			&& method_exists($this->controller, $this->getAction());
	}
	
	public function invoke (
		Container $container, 
		Request $request, 
		Response $response
	) {
		$action = $this->getAction();
		$controller = $this->create($container);
		
		return $controller->$action($request, $response);
	}
	
	protected function create (Container $container) {
		$controller = $this->controller;
		
		return new $controller($container);
	}
	
}