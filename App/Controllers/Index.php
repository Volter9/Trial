<?php namespace App\Controllers;

use Trial\Routing\Controller;

class Index extends Controller {
	
	public function indexAction ($request, $response) {
		$factory = $this->container->get('orm');
		$pages = $factory->table('pages');
		
		return $this->container
			->factory()
			->create('template')
			->view('pages/index', [
				'title' => 'Главная Страница',
				'pages' => $pages->all()
			]);
	}
	
}