<?php namespace App\Controllers;

use Trial\Routing\Controller;

class Auth extends Controller {
	
	public function logInAction () {
		$this->view();
	}
	
	public function logInPostAction () {
		$input = $request->getInput()->post();
		
		$validation = $this->validation->createWrapper('auth');
		
		if (!$validation->validate($input)) {
			return $this->view($validation->getErrors());
		}
		
		
	}
	
	private function view ($errors = true) {
		$language = $this->language;
		
		return $this->template->view('auth/login', [
			'title'  => $language->get('auth.login'),
			'errors' => $errors
		]);
	}
	
}