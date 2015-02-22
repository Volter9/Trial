<?php namespace App\Controllers;

use Trial\Routing\Controller;

class Categories extends Controller {
	
	public function categoryAction ($request, $response) {
		$db = $this->container->get('db.factory');
		
		$template = $this->container->get('template');
		$category = $request->getParameters()->get('category');
		
		return $template->view('pages/index', [
			'title' => 'Категории',
			'pages' => $db->query('pagesByCategory')->fetch($category)
		]);
	}
	
}