<?php namespace App\Queries;

use Trial\DB\Repository\Query;

class Remove extends Query {
	
	private $connection;
	
	public function __construct (Connection $connection) {
		$this->connection = $connection;
	}
	
	public function delete ($table, $id) {
		$sql = sprintf($this->getSQL(), $table);
		
		$statement = $this->connection->query($sql, [$id]);
		
		return $statement->rowCount() > 0;
	}
	
	public function getSQL () {
		return 'DELETE FROM %s WHERE id = ?';
	}
	
}