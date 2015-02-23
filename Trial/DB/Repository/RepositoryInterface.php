<?php namespace Trial\DB\Repository;

use Trial\DB\Connection,
	Trial\DB\Factory;

interface RepositoryInterface {
	
	/**
	 * @param int $id
	 * @return \Trial\DB\Repository\Model
	 */
	public function find ($id);
	
	/**
	 * @param \Trial\DB\Repository\Model
	 */
	public function save (Model $model);
	
	/**
	 * @param int $id
	 * @return bool
	 */
	public function remove ($id);
	
}