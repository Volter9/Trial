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
			
			return $this
				->get('view')
				->create('main', [
					'categories' => $categories
				]);
		};
		
		$container->factory()->register('template', $template);
	}
	
}