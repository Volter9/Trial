<?php namespace App\Queries;

use Trial\DB\Repository\Query;

class All extends Query {
	
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