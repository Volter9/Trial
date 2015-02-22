<?php namespace App\Repositories;

use App\Models\User;

use Trial\DB\Repository;

class Users extends Repository {
	
	protected $table = 'users';
	
	public function find ($id) {
		if (!$result = $this->find->fetch($this->table, $id)) {
			return false;
		}
		
		$user = new User;
		$user->import($result);
		
		return $user;
	}
	
}