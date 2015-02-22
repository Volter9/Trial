<?php namespace Trial\DB\DataMapper;

use Trial\Injection\Container;

class Factory {
	
	private $config;
	private $container;
	private $connections;
	
	public function __construct (Container $container) {
		$this->config = $container
			->factory()
			->create('config', 'mappings');
		
		$this->container = $container;
		$this->connections = $container->get('connections');
	}
	
	public function table ($table, $connection = '') {
		$mapper = $this->config->get("$table.mapper", '\Trial\DB\DataMapper\Mapper');
		$entity = $this->config->get("$table.entity", '\Trial\DB\DataMapper\Entity');
		
		return new $mapper(
			$this->connections->get($connection), 
			$entity, $table
		);
	}
	
}