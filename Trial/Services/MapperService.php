<?php namespace Trial\Services;

use Trial\Injection\Container;
	
use Trial\DB\ORM\Factory;

class MapperService implements Service {
	
	public function register (Container $container) {
		$container->set('orm', new Factory($container));
	}
	
}