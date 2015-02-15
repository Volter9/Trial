<?php namespace App\Controllers;

use Trial\Routing\Controller;

class Categories extends Controller {
	
	public function indexAction ($request, $response) {
		$data = [
			'title' => 'Все категории',
			'view' => 
		];
		
		return $this->viewFactory->create('main', $data);
	}
	
	public function categoryAction ($request, $response) {
		return $this->viewFactory->create('main', $data);
	}
	
}