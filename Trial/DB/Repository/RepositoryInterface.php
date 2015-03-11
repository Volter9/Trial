<?php namespace Trial\DB\Repository;

use Trial\DB\Connection,
	Trial\DB\Factory;

interface RepositoryInterface {
	
	/**
	 * @param int $id
	 * @param string $fields
	 * @return \Trial\DB\Repository\Model
	 */
	public function find ($id, $fields = '*');
	
	/**
	 * @param \Trial\DB\Repository\Model
	 * @return int|bool
	 */
	public function save (Model $model);
	
	/**
	 * @param int $id
	 * @return bool
	 */
	public function remove ($id);
	
}