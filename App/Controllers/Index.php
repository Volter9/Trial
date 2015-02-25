<?php namespace App\Controllers;

use Trial\Routing\Controller;

class Index extends Controller {
	
	public function indexAction ($request, $response) {
		return $this->template->view('index', [
			'title' => $this->language->get('home')
		]);
	}
	
}