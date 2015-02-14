<?php namespace Trial\Services;

use Trial\Injection\Container;
	
use Trial\DB\ORM\Factory;

class MapperService implements Service {
	
	public function register (Container $container) {
		$factory = new Factory($container);
		
		$container->set('orm', $factory);
	}
	
}