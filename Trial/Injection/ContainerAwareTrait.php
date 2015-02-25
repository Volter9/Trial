<?php namespace Trial\Injection;

trait ContainerAwareTrait {
	
	protected $container;
	
	public function __construct (Container $container) {
		$this->container = $container;
	}
	
	public function __get ($key) {
		$key = $this->resolveName($key);
		
		return $this->container->get($key);
	}
	
	private function resolveName ($key) {
		$callback = function ($matches) {
			return strtolower("$matches[1].$matches[2]");
		};
		
		return preg_replace_callback('/([a-z])([A-Z])/', $callback, $key);
	}
	
}