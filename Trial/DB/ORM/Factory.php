<?php namespace Trial\DB\ORM;

use Trial\Injection\Container;

class Factory {
	
	private $config;
	private $container;
	private $connections;
	
	public function __construct (Container $container) {
		$this->container = $container;
		$this->connections = $container->get('connections');
		
		$this->config = $container->factory()->create('config', 'Configs/mappings');
		
	}
	
	public function mapper ($entity, $connection = '') {
		$key = $this->config->get("map.$entity");
		
		$mapper = $this->config->get("$key.mapper", '\Trial\DB\ORM\Mapper');
		$table = $this->config->get("$key.table");
		$relations = $this->config->get("$key.relations");
		
		return new $mapper(
			$this->connections->get($connection), $entity, $table, $relations 
		);
	}
	
}