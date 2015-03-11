<?php namespace Trial\DB;

use Trial\Injection\Container;

class Factory {
	
	/**
	 * @var \Trial\DB\ConnectionManager
	 */
	private $connections;
	
	/**
	 * @var \Trial\Storage\Readable
	 */
	private $queries;
	
	/**
	 * @var \Trial\Storage\Readable
	 */
	private $repositories;
	
	/**
	 * @param \Trial\Injection\Container
	 */
	public function __construct (Container $container) {
		$this->connections = $container->get('connections');
		
		$factory = $container->factory();
		
		$this->queries = $factory->create('config', 'queries');
		$this->repositories = $factory->create('config', 'repositories');
	}
	
	/**
	 * @param string $id
	 * @param string $connection
	 */
	public function query ($id, $connection = '') {
		$class = $this->queries->get($id);
		
		return new $class($this->connections->get($connection));
	}
	
	/**
	 * @param string $id
	 * @param string $type
	 * @param string $connection
	 */
	public function repository ($id, $type = 'sql', $connection = '') {
		$class = $this->repositories->get("$id.$type");
		
		return new $class($this->connections->get($connection), $this);
	}
	
}