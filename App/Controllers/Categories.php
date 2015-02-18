<?php namespace App\Controllers;

use Trial\Routing\Controller;

class Categories extends Controller {
	
	public function categoryAction ($request, $response) {
		return $this->container
			->factory()
			->create('template')
			->view('pages/index', [
				'title' => 'Категория',
			]);
	}
	
}