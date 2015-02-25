<?php namespace App\Queries\Categories;

use App\Queries\Tree as BaseTree;

class Tree extends BaseTree {
	
	public function fetch () {
		$statement = $this->connection->query($this->getSQL());
		
		if ($statement->rowCount() <= 0) {
			return false;
		}
		
		$categories = $statement->fetchAll();
		$categories = $this->group($categories);
		
		return $this->order($categories);
	}
	
	public function getSQL () {
		return 'SELECT id, title, parent_id FROM categories';
	}
	
}