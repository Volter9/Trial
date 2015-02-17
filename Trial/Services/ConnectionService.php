<?php namespace Trial\Services;

use Trial\Injection\Container;

use Trial\DB\ConnectionManager;

class ConnectionService implements Service {
	
	public function register (Container $container) {
		$container->set('connections', new ConnectionManager($container));
	}
	
}