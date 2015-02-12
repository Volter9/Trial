<?php namespace App\Controllers;

use Trial\Routing\Controller;;

class Error extends Controller {
	
	public function indexAction ($request, $response) {
		$response->setCode(404);
		
		return $this->viewFactory->create('404', [
			'title' => 'Страница не была найдена &mdash; 404'
		]);
	}
	
}