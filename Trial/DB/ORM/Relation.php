<?php namespace Trial\DB\ORM;

abstract class Realtion {
	
	protected $factory;
	protected $entity;
	protected $relations;
	
	public function __construct (Factory $factory, $entity, array $relations) {
		$this->factory = $factory;
		$this->entity = $entity;
		$this->relations = $relations;
	}
	
	abstract public function relate (Entity $entity);
	
}