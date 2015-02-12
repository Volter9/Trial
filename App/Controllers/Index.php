<?php namespace App\Controllers;

use Trial\Routing\Controller;

use Trial\Core\Collection;

class Index extends Controller {
	
	public function indexAction ($request, $response) {
		return $this->viewFactory->create('main', [
			'title' => 'test',
			'test' => 'title',
			'view' => 'index'
		]);
	}
	
}