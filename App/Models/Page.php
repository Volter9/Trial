<?php namespace App\Models;

use Trial\DB\Model;

class Page extends Model {
	
	public $id;
	public $title;
	public $description;
	public $text;
	public $date;
	public $user_id;
	public $category_id;
	
	public $user;
	public $category;
	
}