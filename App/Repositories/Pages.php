<?php namespace App\Repositories;

use Trial\DB\Repository;

class Pages extends Repository {
	
	protected $table = 'pages';
	protected $model = '\App\Models\Page';
	
}