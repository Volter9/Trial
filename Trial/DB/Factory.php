<?php namespace Trial\DB;

use Trial\Injection\Container;

class Factory {
	
	private $container;
	private $connections;
	
	private $queries;
	private $repositories;
	
	public function __construct (Container $container) {
		$this->container = $container;
		$this->connections = $container->get('connections');
		
		$factory = $container->factory();
		
		$this->queries = $factory->create('config', 'queries');
		$this->repositories = $factory->create('config', 'repositories');
	}
	
	public function query ($id, $connection = 'default') {
		$class = $this->queries->get($id);
		
		$connection = $this->connections->get($connection);
		
		return $class ? new $class($connection) : false;
	}
	
	public function repository ($id, $type = 'sql', $connection = 'default') {
		$class = $this->repositories->get("$id.$type");
		
		$connection = $this->connections->get($connection);
		
		return $class ? new $class($connection, $this) : false;
	}
	
}