<?php namespace Trial\Services;

use Trial\Storage\PHPConfig;

use Trial\Injection\Container;

class LanguageService implements Service {
	
	public function register (Container $container) {
		$config = $container->get('configs.app')->get('language');
		
		$path = "{$config['folder']}{$config['default']}";
		$path = $container->get('app.path')->build($path);
		
		$container->set('language', new PHPConfig($path));
	}
	
}