<?php namespace Trial\DB\Repository;

use Trial\DB\Connection,
	Trial\DB\Factory;

interface RepositoryInerface {
	
	public function __construct (Connection $connection, Factory $factory);
	
	public function find ($id);
	public function save (Model $model);
	public function remove ($id);
	
}