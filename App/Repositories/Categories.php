<?php namespace App\Repositories;

use App\Models\Category;

use Trial\DB\Repository;

class Categories extends Repository {
	
	protected $table = 'categories';
	
	public function find ($id) {
		if (!$result = $this->find->fetch($this->table, $id)) {
			return false;
		}
		
		$user = new Category;
		$user->import($result);
		
		return $user;
	}
	
}