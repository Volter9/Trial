<?php namespace App\Controllers;

use Trial\Routing\Controller;

class Pages extends Controller {
	
	public function indexAction ($request, $response) {
		$db = $this->dbFactory;
		
		return $this->template->view('pages/index', [
			'title' => $this->language->get('pages.all'),
			'pages' => $db->query('pages')->fetch()
		]);
	}
	
	public function pageAction ($request, $response) {
		$db = $this->dbFactory;
		
		$page = $request->get('page');
		$page = $db->repository('pages')->find($page);
		
		if (!$page) {
			throw new Exception('Not Found');
		}
		
		$page->user = $db->repository('users')->find($page->user_id);
		$page->category = $db->repository('categories')->find($page->category_id);
		
		$comments = $db->query('commentTree')->fetch('pages', $page->id);
		
		$title = sprintf($this->language->get('pages.one') . ' "%s"', $page->title);
		
		return $this->template->view('pages/page', [
			'title'    => $title,
			'page'     => $page,
			'comments' => $comments
		]);
	}
	
}