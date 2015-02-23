<?php namespace App\Controllers;

use Trial\Routing\Controller;

class Categories extends Controller {
	
	public function categoryAction ($request, $response) {
		$container = $this->container;
		$parameters = $request->getParameters();
		
		$db = $container->get('db.factory');
		$categories = $db->repository('categories');
		
		$template = $container->get('template');
		$category = $categories->find($parameters->get('category'));
		
		return $template->view('pages/index', [
			'title' => sprintf('Категория "%s"', $category->title),
			'pages' => $db->query('pagesByCategory')->fetch($category->id)
		]);
	}
	
}