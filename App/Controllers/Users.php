<?php namespace App\Controllers;

use Trial\Routing\Controller;

class Users extends Controller {
	
	public function indexAction ($request, $response) {
		$container = $this->container;
		
		$db = $container->get('db.factory');
		$users = $db->query('users')->fetch();
		
		$template = $container->get('template');
		
		return $template->view('users/index', [
			'title' => 'Все пользователи',
			'users' => $users
		]);
	}
	
	public function userAction ($request, $response) {
		
	}
	
}