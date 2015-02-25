<?php namespace App\Repositories;

use Trial\DB\Repository;

class Users extends Repository {
	
	protected $table = 'users';
	protected $model = '\App\Models\User';
	
}