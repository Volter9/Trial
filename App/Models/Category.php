<?php namespace App\Models;

use Trial\DB\Model;

class Category extends Model {
	
	public $id;
	public $title;
	public $description;
	public $parent_id;
	
}