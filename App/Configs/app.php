<?php

/**
 * Application config
 * 
 * @package Trial
 */

return [
	'services' => [
		'\Trial\Services\ConnectionService',
		'\Trial\Services\ViewService',
		'\Trial\Services\MapperService',
		
		// '\App\Services\AuthService'
		'\App\Services\TemplatesService'
	],
	
	'assets' => '/oop_cms/assets/'
];