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
		'\Trial\Services\LanguageService',
		'\Trial\Services\ViewService',
		'\Trial\Services\DatabaseService',
		'\Trial\Services\ErrorHandlerService',
		
		// '\App\Services\GuardService',
		'\App\Services\TemplatesService'
	],
	
	'language' => [
		'default' => 'ru',
		'folder' => 'I18n/'
	]
];