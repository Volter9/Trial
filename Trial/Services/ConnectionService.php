<?php namespace Trial\Services;

use Trial\Injection\Container,
	Trial\DB\ConnectionManager;

class ConnectionService extends Service {
	
	public function register () {
		$this->container->set(
			'connections', new ConnectionManager($this->container)
		);
	}
	
}