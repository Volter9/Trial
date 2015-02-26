<?php namespace App\Queries\Comments;

use App\Queries\Tree as BaseTree;

class Tree extends BaseTree {
	
	public function fetch ($destination, $id) {
		$sql = $this->getSQL();
		$statement = $this->connection->query($sql, [$destination, $id]);
		
		if ($statement->rowCount() <= 0) {
			return false;
		}
		
		$comments = $statement->fetchAll();
		$comments = $this->group($comments);
		
		return $this->order($comments);
	}
	
	public function getSQL () {
		return '
			SELECT 
				c.id, c.parent_id, c.text, c.user_id, c.date, u.username
			FROM __comments c
			LEFT JOIN __users u ON (c.user_id = u.id)
			LEFT JOIN __bind_comments b ON (b.comment_id = c.id)
			WHERE b.destination = ? AND b.destination_id = ?
			ORDER BY c.id
		';
	}
	
}