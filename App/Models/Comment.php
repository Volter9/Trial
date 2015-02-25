<?php namespace App\Models;

use Trial\DB\Model;

class Comment extends Model {
	
	public $id;
	public $text;
	public $date;
	public $user_id;
	public $parent_id;
	
}