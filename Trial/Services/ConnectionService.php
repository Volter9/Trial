<?php namespace Trial\Services;

use Trial\Injection\Container;

use Trial\DB\ConnectionManager;

class ConnectionService implements Service {
	
	public function register (Container $container) {
		$factory = $container->factory();
		
		$container->set('configs.db', $factory->create('config', 'database'));
		$container->set('connections', 
			new ConnectionManager($container->get('configs.db'))
		);
	}
	
}