<?php namespace Trial\Routing\Route;

class Action {
	
	private $controller;
	private $action;
	
	static public function fromString ($controller) {
		$action = 'index';
		
		if (strpos($controller, '::') !== false) {
			list($controller, $action) = explode('::', $controller);
		}
		
		return new static($controller, $action);
	}
	
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
	
	public function toArray () {
		return [
			$this->controller, 
			$this->getAction()
		];
	}
	
}