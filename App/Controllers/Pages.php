<?php namespace App\Controllers;

use Trial\Routing\Controller;

class Pages extends Controller {
	
	public function indexAction ($request, $response) {
		
	}
	
	public function pageAction ($request, $response) {
		var_dump($request->getParameters()->get('page'));
	}
	
}