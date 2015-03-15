<?php namespace Trial\Services;

use Trial\Injection\Container;

use Trial\DB\ConnectionManager;

class ConnectionService implements Service {
	
	public function register (Container $container) {
		$factory = $container->factory();
		
		$config = $factory->create('config', 'database');
		$connections = new ConnectionManager($config);
		
		$container->set('db.connections', $connections);
	}
	
}