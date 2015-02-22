<?php namespace Trial\Services;

use Trial\Injection\Container;

use Trial\DB\Factory;

class DatabaseService implements Service {
	
	public function register (Container $container) {
		$container->set('db.factory', new Factory($container));
	}
	
}