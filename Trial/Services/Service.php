<?php namespace Trial\Services;

use Trial\Injection\Container;

abstract class Service {
	
	protected $container;
	
	public function __construct (Container $container) {
		$this->container = $container;
	}
	
	abstract public function register ();
	
}