<?php namespace App\Queries;

use Trial\DB\Repository\Query;

class Update extends Query {
	
	public function update ($table, $id, array $data) {
		$data[] = $id;
		$values = $this->prepareValues($data);
		
		$sql = sprintf($this->getSQL(), $table, $values);
		
		$statement = $this->connection->query($sql, $data);
		
		return $statement->rowCount() > 0;
	}
	
	private function prepareValues ($data) {
		$callback = function ($value, $key) {
			return "$key = ?";
		};
		
		$data = array_map($callback, $data);
		
		return implode(',', $data);
	}
	
	public function getSQL () {
		return 'UPDATE %s SET %s WHERE id = ?';
	}
	
}