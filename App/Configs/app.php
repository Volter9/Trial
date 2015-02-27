<?php

/**
 * Application config
 * 
 * @package Trial
 */

return [
	'services' => [
		'\Trial\Services\RoutingService',
		'\Trial\Services\LanguageService',
		'\Trial\Services\ViewService',
		'\Trial\Services\ErrorHandlerService',
		'\Trial\Services\ConnectionService',
		'\Trial\Services\DatabaseService',
		
		'\App\Services\GuardService',
		'\App\Services\TemplatesService'
	],
	
	'language' => [
		'default' => 'ru',
		'folder' => 'I18n/'
	]
];