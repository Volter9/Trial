<?php namespace App\Services;

use Trial\Injection\Container;

use Trial\Services\Service;

class TemplatesService implements Service {
	
	public function register (Container $container) {
		$factory = $container->get('db.factory');
		
		$categories = $factory
			->query('categoryTree')
			->fetch();
		
		$viewFactory = $container->get('view');
		
		$template = $viewFactory->create('main', [
			'categories' => $categories
		]);
		
		$container->set('template', $template);
	}
	
}