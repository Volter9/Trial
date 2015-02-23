<?php namespace App\Queries\Categories;

use Trial\DB\Repository\Query;

class Tree extends Query {
	
	public function fetch () {
		$sql = $this->getSQL();
		$statement = $this->connection->query($sql);
		
		if ($statement->rowCount() <= 0) {
			return false;
		}
		
		$categories = $this->group($statement->fetchAll());
		
		return $this->order($categories);
	}
	
	public function group (array $categories) {
		$result = [];
		
		foreach ($categories as $category) {
			$result[$category['id']] = $category;
		}
		
		return $result;
	}
	
	public function order (array $categories) {
		$result = [];
		
		foreach ($categories as $id => &$category) {
			$parent_id = (int)$category['parent_id'];
			
			if ($parent_id === 0) {
				$result[$id] = &$category;
			}
			else {
				$categories[$parent_id]['sub'][] = &$category;
			}
		}
		
		return $result;
	}
	
	public function getSQL () {
		return 'SELECT id, title, parent_id FROM categories';
	}
	
}