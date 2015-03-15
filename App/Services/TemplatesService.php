<?php namespace App\Services;

use Trial\Injection\Container;

use Trial\Services\Service;

class TemplatesService implements Service {
	
	public function register (Container $container) {
		$factory     = $container->get('db.factory');
		$viewFactory = $container->get('view');
		
		$template = $viewFactory->createTemplate('main', [
			'categories' => $factory->query('categoryTree')->fetch()
		]);
		
		$container->set('template', $template);
	}
	
}