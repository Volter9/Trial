<?php namespace App\Queries\Pages;

use Trial\DB\Repository\Query;

class ByCategory extends Query {
	
	public function fetch ($id) {
		$sql = $this->getSQL();
		
		$statement = $this->connection->query($sql, [$id]);
		
		return $statement->rowCount() > 0
			? $statement->fetchAll()
			: false;
	}
	
	public function getSQL () {
		return '
			SELECT 
				p.id, p.title, p.description, p.date, p.category_id, 
				p.user_id, u.username as user, c.title as category 
			FROM __pages p
			LEFT JOIN __users u ON (u.id = p.user_id)
			LEFT JOIN __categories c ON (c.id = p.category_id)
			WHERE p.category_id = ?
			ORDER BY p.date DESC
		';
	}
	
}