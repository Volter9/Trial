<?php namespace App\Entities;

use Trial\DB\ORM\Entity;

class Comment extends Entity {
	
	public static $table = 'comments';
	public static $mapper = '\App\Mappers\Comments';
	
}