<?php namespace Trial\DB\ORM;

use Trial\Core\Collection;

/**
 * Relation
 * 
 * Null object, extend to provide custom behavior
 * 
 * @package Trial
 */

abstract class Relation {
	
	protected $factory;
	protected $mapper;
	protected $relations;
	
	public function __construct (Factory $factory, array $relations) {
		$this->factory = $factory;
		$this->relations = $relations;
		
		$this->initialize();
	}
	
	protected function initialize () {}
	
	public function relate (Collection $collection) {
		foreach ($collection as $entity) {
			$this->relateOne($entity);
		}
		
		return $collection;
	}
	
	abstract public function relateOne (Entity $entity);
	
}