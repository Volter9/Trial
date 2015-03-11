<?php namespace Trial\DB\Repository;

use Trial\DB\Connection;

abstract class Query {
	
	protected $connection;
	
	/**
	 * @param \Trial\DB\Connection
	 */
	public function __construct (Connection $connection) {
		$this->connection = $connection;
	}
	
	/**
	 * @return string
	 */
	abstract public function getSQL ();
	
}