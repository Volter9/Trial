<?php namespace App\Controllers;

use Exception;

use Trial\Routing\Controller;

class Categories extends Controller {
	
	public function categoryAction ($request, $response) {
		$db = $this->dbFactory;
		
		$categories = $db->repository('categories');
		$category = $categories->find(
			$request->get('category')
		);
		
		if (!$category) {
			throw new Exception(
				sprintf('Category by id %s is not exists!', $request->get('category'))
			);
		}
		
		$comments = $db
			->query('commentTree')
			->fetch('categories', $category->id);
		
		$pages = $db
			->query('pagesByCategory')
			->fetch($category->id);
		
		$title = sprintf(
			$this->language->get('category.one') . ' "%s"', $category->title
		);
		
		return $this->template->view('category', [
			'title' => $title,
			'category' => $category,
			'pages'    => $pages,
			'comments' => $comments
		]);
	}
	
}