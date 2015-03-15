<?php namespace Trial\Services;

use Trial\Data\Factory,
	Trial\Data\Validators;

use Trial\Injection\Container;

class ValidationService implements Service {
	
	public function register (Container $container) {
		$factory = $container->factory();
		$path    = $container->get('app.path');
		
		$rules    = $factory->create('config', 'rules');
		$language = $container->get('language');
		
		$validators = include $path->build('Configs/validators');
		$validators = new Validators($validators);		
		
		$factory = new Factory($rules, $language, $validators);
		
		$container->set('validation', $factory);
	}
	
}