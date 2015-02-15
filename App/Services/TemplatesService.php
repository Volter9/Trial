<?php namespace App\Services;

use Trial\Injection\Container;

use Trial\Services\Service;

class TemplatesService implements Service {
	
	public function register (Container $container) {
		$template = function () {
			$categories = $this
				->get('orm')
				->table('categories')
				->all();
			
			$template = $this
				->get('view')
				->create('main', [
					'categories' => $categories
				]);
			
			return $template;
		};
		
		$container->factory()->register('template', $template);
	}
	
}