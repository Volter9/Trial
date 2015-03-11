<?php

/**
 * Validation rules
 * 
 * @package Trial
 */

return [
	'auth.login' => [
		'username' => 'required|length:4,20',
		'password' => 'required|length:4,20'
	]
];