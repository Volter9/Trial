<?php namespace App\Queries;

use Trial\DB\Connection;

class Insert {
	
	private $connection;
	
	public function __construct (Connection $connection) {
		$this->connection = $connection;
	}
	
	public function insert ($table, array $data) {
		$columns = implode(',', array_keys($data));
		$values = chop(str_repeat('?, ', count($data)), ', ');
		
		$sql = sprintf($this->getSQL(), $table, $columns, $values);

		$statement = $this->connection->query($sql, $data);
		
		return $this->connection->getConnection()->lastInsertId();
	}
	
	public function getSQL () {
		return 'INSERT INTO %s (%s) VALUES %s';
	}
	
}