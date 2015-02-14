<?php namespace Trial\Services;

use Trial\Injection\Container;

interface Service {
	
	public function register (Container $container);
	
}