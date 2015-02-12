<?php namespace Trial\DB\ORM;

use Trial\Injection\Container;

class Factory {
	
	private $container;
	private $connections;
	
	public function __construct (Container $container) {
		$this->container = $container;
		$this->connections = $container->get('connections');
	}
	
	public function mapper ($entity, $connection = '') {
		return new $entity::$mapper(
			$this->connections->get($connection), $entity
		);
	}
	
}