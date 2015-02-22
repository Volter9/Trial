<?php namespace App\Queries;

use Trial\DB\Connection;

class Update {
	
	private $connection;
	
	public function __construct (Connection $connection) {
		$this->connection = $connection;
	}
	
	public function update ($table, $id, array $data) {
		$values = implode(', ', array_map(function ($value, $key) {
			return "$key = ?";
		}, $data));
		
		$sql = sprintf($this->getSQL(), $table, $values);
		
		$data = array_merge($data, $id);
		$statement = $this->connection->query($sql, $data);
		
		return $statement->rowCount() > 0;
	}
	
	public function getSQL () {
		return 'UPDATE %s SET %s WHERE id = ?';
	}
	
}