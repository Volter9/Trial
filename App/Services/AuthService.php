<?php namespace App\Services;

use Trial\Injection\Container;

use Trial\Services\Service;

class AuthService implements Service {
	
	public function register (Container $container) {
		$mapper = $container->get('orm')
			->mapper('\App\Entities\User');
		
		// Test
		$user = $mapper->get(1);
	}
	
}