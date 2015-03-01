<?php namespace App\Controllers;

use Trial\Routing\Controller;

class Auth extends Controller {
	
	public function logInAction ($request, $response) {
		return $this->view();
	}
	
	public function logInPostAction ($request, $response) {
		
	}
	
	private function view ($error = '') {
		return $this->template->view('auth/login', [
			'title' => $this->language->get('auth.login'),
			'error' => $error
		]);
	}
	
}