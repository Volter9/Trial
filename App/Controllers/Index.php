<?php namespace App\Controllers;

use Trial\Routing\Controller;

class Index extends Controller {
	
	public function indexAction ($request, $response) {
		return $this->viewFactory->create('main', [
			'title' => 'test',
			'test' => 'title',
			'view' => 'index'
		]);
	}
	
}