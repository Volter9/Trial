<?php namespace App\Repositories;

use Trial\DB\Repository;

class Categories extends Repository {
	
	protected $table = 'categories';
	protected $model = '\App\Models\Category';
	
}