<?php namespace App\Repositories;

use Trial\DB\Repository;

class Comments extends Repository {
	
	protected $table = 'comments';
	protected $model = '\App\Models\Comment';
	
}