<?php namespace App\Controllers;

use Trial\Routing\Controller;

class Index extends Controller {
	
	public function indexAction ($request, $response) {
		$data = [
			'title' => $this->language->get('home')
		];
		
		return $this->template->view('index', $data);
	}
	
}