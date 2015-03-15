<?php namespace App\Queries\Categories;

use App\Queries\Tree as BaseTree;

class Tree extends BaseTree {
	
	public function fetch () {
		$statement = $this->connection->query($this->getSQL());
		
		return $this->createTree($statement);
	}
	
	public function getSQL () {
		return 'SELECT id, title, parent_id FROM __categories';
	}
	
}