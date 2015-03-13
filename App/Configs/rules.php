<?php

/**
 * Validation rules
 * 
 * @package Trial
 */

return [
	'auth.login' => [
		'username' => 'required|length:4,20|alpha_dash',
		'password' => 'required|length:4,20|alpha_dash'
	]
];