<?php namespace App\Queries\Users;

use Trial\DB\Repository\Query;

class All extends Query {
	
	public function fetch () {
		$sql = $this->getSQL();
		$statement = $this->connection->query($sql);
		
		return $statement->rowCount() > 0
			? $statement->fetchAll()
			: false;
	}
	
	public function getSQL () {
		return '
			SELECT 
				u.id, u.username, u.registered_at,
				g.title
			FROM __users u
			LEFT JOIN __groups g ON (g.id = u.group_id)
			ORDER BY id DESC
		';
	}
	
}