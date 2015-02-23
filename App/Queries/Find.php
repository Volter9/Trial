<?php namespace App\Queries;

use Trial\DB\Repository\Query;

class Find extends Query {
	
	public function fetch ($table, $id, $fields = '*') {
		$sql = sprintf($this->getSQL(), $fields, $table);
		
		$statement = $this->connection->query($sql, [$id]);
		
		return $statement->rowCount() > 0
			? $statement->fetch()
			: false;
	}
	
	public function getSQL () {
		return 'SELECT %s FROM %s WHERE id = ?';
	}
	
}