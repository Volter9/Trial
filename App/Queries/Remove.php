<?php namespace App\Queries;

use Trial\DB\Repository\Query;

class Remove extends Query {
	
	public function delete ($table, $id) {
		$sql = sprintf($this->getSQL(), $table);
		
		$statement = $this->connection->query($sql, [$id]);
		
		return $statement->rowCount() > 0;
	}
	
	public function getSQL () {
		return 'DELETE FROM __%s WHERE id = ?';
	}
	
}