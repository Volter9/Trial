<?php namespace App\Controllers;

use Exception;

use Trial\Routing\Controller;

class Categories extends Controller {
	
	public function categoryAction ($request, $response) {
		$db = $this->dbFactory;
		
		$categories = $db->repository('categories');
		
		$category_id = $request->get('category');
		$category = $categories->find($category_id);
		
		if (!$category) {
			throw new Exception(
				sprintf('Category by id %s is not exists!', $category_id)
			);
		}
		
		$comments = $db
			->query('commentTree')
			->fetch('categories', $category_id);
		
		$pages = $db
			->query('pagesByCategory')
			->fetch($category_id);
		
		$title = sprintf(
			$this->language->get('category.one') . ' "%s"', $category->title
		);
		
		return $this->template->view('category', [
			'title'    => $title,
			'category' => $category,
			'pages'    => $pages,
			'comments' => $comments
		]);
	}
	
}