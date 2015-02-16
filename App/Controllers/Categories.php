<?php namespace App\Controllers;

use Trial\Routing\Controller;

class Categories extends Controller {
	
	public function indexAction ($request, $response) {
		return $this->container
			->factory()
			->create('template')
			->view('categories/index', [
				'title' => 'Категории',
			]);
	}
	
	public function categoryAction ($request, $response) {
		return $this->container
			->factory()
			->create('template')
			->view('categories/category', [
				'title' => 'Категория',
			]);
	}
	
}