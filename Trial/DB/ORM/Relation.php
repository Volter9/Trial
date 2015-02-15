<?php namespace Trial\DB\ORM;

/**
 * Relation
 * 
 * Null object, extend to provide custom behavior
 * 
 * @package Trial
 */

class Relation {
	
	protected $factory;
	protected $mapper;
	protected $relations;
	
	public function __construct (Factory $factory, array $relations) {
		$this->factory = $factory;
		$this->relations = $relations;
	}
	
	public function setMapper (Mapper $mapper) {
		$this->mapper = $mapper;
	}
	
	public function relate (Entity $entity) {
		return $entity;
	}
	
}