<?php namespace App\Services;

use Trial\Injection\Container;

use Trial\Services\Service;

class GuardService implements Service {
	
	public function register (Container $container) {
		$mapper = $container->get('orm')->mapper('\App\Entities\User');
		
		$user = $mapper->get(1);
	}
	
}