<?php namespace App\Services;

use Trial\Injection\Container;

use Trial\Services\Service;

class TemplatesService implements Service {
	
	public function register (Container $container) {
		$categories = $container->get('orm')->table('categories')->all();
		
		$container->set(
			'templates.main', $container->get('view')->create('main', [
				'categories' => $categories
			])
		);
	}
	
}