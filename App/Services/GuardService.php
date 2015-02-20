<?php namespace App\Services;

use Trial\Injection\Container;

use Trial\Services\Service;

class GuardService implements Service {
	
	public function register (Container $container) {
		$mapper = $container->get('orm')->table('users');
		
		$user = $mapper->get(1);
	}
	
}