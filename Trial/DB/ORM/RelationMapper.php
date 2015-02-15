<?php namespace Trial\DB\ORM;

use Trial\Config;

class RelationMapper {
	
	private $config;
	private $factory;
	private $relations;
	
	public function __construct (
		Factory $factory, 
		Config $config, 
		array $relations
	) {
		$this->config = $config;
		$this->factory = $factory;
		$this->relations = $relations;
	}
	
	public function relate (Entity $entity, $limit = '*') {
		
	}
	
}