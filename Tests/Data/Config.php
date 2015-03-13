<?php namespace Tests\Data;

class Config {
	
	public static $messages = [
		'required'  => 'The field "%s" is required!',
		'alphadash' => 'The field "%s" should be an alpha numeric!',
		'length'    => 'The field "%s" should be between %s and %s!'
	];
	
	public static $fields = [
		'username' => 'Cool user name',
		'password' => 'Unique ID of Swagger'
	];
	
	public static function validators () {
		return [
			'required' => function ($value) {
				return !!$value;
			},
			
			'length' => function ($value, $key, $min, $max) {
				$min = $min === ''   ? 0           : (int)$min;
				$max = $max === null ? PHP_INT_MAX : (int)$max;
				
				$length = strlen($value);
				
				return $length <= $max && $length >= $min; 
			},
			
			'alphadash' => function ($value) {
				return (bool)preg_match('/^[\w\d\-\_]+$/i', $value);
			}
		];
	}
	
}