<?php namespace Trial\Services;

use Trial\Injection\Container;

use Trial\DB\Factory;

class DatabaseService implements Service {
	
	public function register (Container $container) {
		$factory = $container->factory();
		
		$connections  = $container->get('db.connections');
		$queries      = $factory->create('config', 'queries');
		$repositories = $factory->create('config', 'repositories');
		
		$container->set('db.factory', 
			new Factory($connections, $queries, $repositories)
		);
	}
	
}