<?php namespace Trial\Injection;

class Factory {
	
	private $container;
	private $factories = [];
	
	public function __construct (Container $container) {
		$this->container = $container;
	}
	
	public function register ($name, callable $callback) {
		$callback = $callback->bindTo($this->container);
		
		$this->factories[$name] = $callback;
	}
	
	public function create ($name) {
		if (!isset($this->factories[$name])) {
			return false;
		}
		
		$params = array_slice(func_get_args(), 1);
		$callback = $this->factories[$name];
		
		return call_user_func_array($callback, $params);
	}
	
}