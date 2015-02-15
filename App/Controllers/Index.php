<?php namespace App\Controllers;

use Trial\Routing\Controller;

class Index extends Controller {
	
	public function indexAction ($request, $response) {
		$factory = $this->container->get('orm');
		
		$pages = $factory->mapper('\App\Entities\Page');
		
		$data = [
			'title' => 'Главная Страница',
			'view' => 'pages',
			'pages' => $pages->all()
		];
				
		return $this->viewFactory->create('main', $data);
	}
	
}