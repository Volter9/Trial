<?php namespace App\Controllers;

use Trial\Routing\Controller;

class Categories extends Controller {
	
	public function categoryAction ($request, $response) {
		$container = $this->container;
		$parameters = $request->getParameters();
		
		$db = $container->get('db.factory');
		
		$template = $container->get('template');
		$category = $parameters->get('category');
		
		return $template->view('pages/index', [
			'title' => 'Категории',
			'pages' => $db->query('pagesByCategory')->fetch($category)
		]);
	}
	
}