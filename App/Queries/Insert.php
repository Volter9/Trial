<?php namespace App\Queries;

use Trial\DB\Repository\Query;

class Insert extends Query {
	
	public function insert ($table, array $data) {
		$keys = array_keys($data);
		
		$columns = $this->prepareColumns($keys);
		$values = $this->prepareValues($data);
		$sql = sprintf($this->getSQL(), $table, $columns, $values);

		$statement = $this->connection->query($sql, $data);
		
		return $this->connection->getConnection()->lastInsertId();
	}
	
	private function prepareColumns (array $keys) {
		return implode(',', $keys);
	}
	
	private function prepareValues (array $data) {
		return chop(str_repeat('?, ', count($data)), ', ')
	}
	
	public function getSQL () {
		return 'INSERT INTO %s (%s) VALUES %s';
	}
	
}