<?php namespace App\Services;

use Trial\Injection\Container;

use Trial\Services\Service;

class TemplatesService implements Service {
	
	public function register (Container $container) {
		$categories = $container
			->get('db.factory')
			->query('all')
			->fetch('categories');
		
		$viewFactory = $container->get('view');
		
		$template = $viewFactory->create('main', [
			'categories' => $categories
		]);
		
		$container->set('template', $template);
	}
	
}