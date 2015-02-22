<?php

/**
 * Application config
 * 
 * @package Trial
 */

return [
	'services' => [
		'\Trial\Services\RoutingService',
		'\Trial\Services\ConnectionService',
		'\Trial\Services\ViewService',
		'\Trial\Services\DatabaseService',
		
		// '\App\Services\GuardService',
		'\App\Services\TemplatesService'
	],
	
	'assets' => '/oop_cms/assets/'
];