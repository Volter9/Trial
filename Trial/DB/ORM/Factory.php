<?php namespace Trial\DB\ORM;

use Trial\Injection\Container;

class Factory {
	
	private $config;
	private $container;
	private $connections;
	private $relations;
	
	public function __construct (Container $container) {
		$this->config = $container
			->factory()
			->create('config', 'Configs/mappings');
		
		$this->container = $container;
		$this->connections = $container->get('connections');
		$this->relations = $this->config->get('relations');
	}
	
	public function table ($table, $connection = '') {
		$mapper = $this->config->get("$table.mapper", '\Trial\DB\ORM\Mapper');
		$entity = $this->config->get("$table.entity", '\Trial\DB\ORM\Entity');
		
		return new $mapper(
			$this->connections->get($connection), $entity, $table
		);
	}
	
	public function relation ($table) {
		$relation = $this->config->get("$table.relations");
		
		$type = $relation['type'];
		$class = $this->relations[$type];
		
		return new $class($this, $relation);
	}
	
}