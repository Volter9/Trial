<?php namespace Trial\DB\ORM;

use Trial\Injection\Container;

class Factory {
	
	private $config;
	private $container;
	private $connections;
	private $relations;
	
	public function __construct (Container $container) {
		$this->container = $container;
		$this->connections = $container->get('connections');
		
		$this->config = $container->factory()->create('config', 'Configs/mappings');
		$this->relations = $this->config->get('relations');
	}
	
	public function mapper ($entity, $connection = '') {
		return $this->table(
			$this->config->get("map.$entity")
		);
	}
	
	public function table ($table, $connection = '') {
		$mapper = $this->config->get("$table.mapper", '\Trial\DB\ORM\Mapper');
		$entity = $this->config->get("$table.entity", '\Trial\DB\ORM\Entity');
		$relation = $this->config->get("$table.relations");
		
		return new $mapper(
			$this->connections->get($connection), 
			$entity, 
			$table, 
			$this->relation($relation)
		);
	}
	
	protected function relation ($info) {
		$type = $info['type'];
		$class = $this->relations[$type];
		
		return new $class($this, $info);
	}
	
}