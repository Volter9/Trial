<?php namespace App\Models;

use Trial\DB\Model;

class User extends Model {
	
	public $id;
	public $username;
	public $password;
	public $group_id;
	public $registered_at;
	
}