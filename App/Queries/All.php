<?php namespace App\Queries;

use Trial\DB\Connection;

class All {
	
	private $connection;
	
	public function __construct (Connection $connection) {
		$this->connection = $connection;
	}
	
	public function fetch ($table, $fields = '*') {
		$sql = sprintf($this->getSQL(), $fields, $table);
		
		$statement = $this->connection->query($sql);
		
		return $statement->rowCount() > 0
			? $statement->fetchAll()
			: false;
	}
	
	public function getSQL () {
		return 'SELECT %s FROM %s';
	}
	
}