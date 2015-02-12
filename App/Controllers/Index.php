<?php namespace App\Controllers;

use Trial\Routing\Controller;

use Trial\Core\Collection;

class Index extends Controller {
	
	public function indexAction ($request, $response) {
		$data = [
			'title' => 'test',
			'test' => 'title',
			'view' => 'index'
		];
		
		$mapper = $this->container
			->get('orm')
			->mapper('\App\Entities\Page');
		
		return $this->viewFactory->create('main', $data);
	}
	
	public function jsonAction ($request, $response) {
		$response->json([
			'status' => 200,
			'message' => 'Well, hello!'
		]);
	}
	
	public function coolAction ($request, $response) {
		$response->redirect('/');
	}
	
}