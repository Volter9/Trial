<?php namespace Trial\DB;

use Trial\Injection\Container;

class ConnectionManager {
	
	private $config;
	private $connections = [];
	
	public function __construct (Container $container) {
		$this->config = $container->get('configs.db');
		
		if ($this->config->get('autoload')) {
			$this->connect();
		}
	}
	
	public function get ($group) {
		$group = $group ?: 'default';
		
		if (!isset($this->connections[$group])) {
			$this->connect($group);
		}
		
		return $this->connections[$group];
	}
	
	public function connect ($group = 'default') {
		$config = $this->config->get($group);
		
		if (!$config) {
			return false;
		}
		
		$connection = new Connection($config);
		$connection->connect();
		
		$this->connections[$group] = $connection;
	}
	
}