<?php namespace Trial\DB;

use Trial\Config;

class ConnectionManager {
	
	private $config;
	private $connections = [];
	
	public function __construct (Config $config) {
		$this->config = $config;
		
		if ($this->config->get('autoload')) {
			$this->connect();
		}
	}
	
	public function get ($group = '') {
		$group = $group ?: 'default';
		
		if (!isset($this->connections[$group])) {
			$this->connect($group);
		}
		
		return $this->connections[$group];
	}
	
	public function connect ($group = '') {
		$group = $group ?: 'default';
		
		$config = $this->config->get($group);
		
		if (!$config) {
			return false;
		}
		
		$connection = new Connection($config);
		$connection->connect();
		
		$this->connections[$group] = $connection;
	}
	
}