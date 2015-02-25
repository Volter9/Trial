<?php 

/**
 * Queries
 */

return [
	'find' => '\App\Queries\Find',
	'insert' => '\App\Queries\Insert',
	'update' => '\App\Queries\Update',
	'remove' => '\App\Queries\Remove',
	'all' => '\App\Queries\All',
	
	'pages' => '\App\Queries\Pages\All',
	'pagesByCategory' => '\App\Queries\Pages\ByCategory',
	
	'categoryTree' => '\App\Queries\Categories\Tree',
	
	'users' => '\App\Queries\Users\All',
	
	/**
	 * I wonder how
	 * I wonder why
	 * Yesterday you told me 'bout the blue blue sky
	 * And I all that I can see is just another comment tree
	 * I'm scrolling the page up and down
	 * I'm turning turning turning turning my head around
	 * And I all that I can see is just another comment tree
	 */
	'commentTree' => '\App\Queries\Comments\Tree'
];