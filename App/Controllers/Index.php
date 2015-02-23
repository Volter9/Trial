<?php namespace App\Controllers;

use Trial\Routing\Controller;

class Index extends Controller {
	
	public function indexAction ($request, $response) {
		$container = $this->container;
		
		$db = $container->get('db.factory');
		$template = $container->get('template');
		
		return $template->view('pages/index', [
			'title' => 'Главная Страница',
			'pages' => $db->query('pages')->fetch()
		]);
	}
	
}