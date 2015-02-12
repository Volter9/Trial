<?php namespace App\Entities;

use Trial\DB\ORM\Entity;

class Category extends Entity {
	
	public static $table = 'categories';
	public static $mapper = '\App\Mappers\Categories';
	
}