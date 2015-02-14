<?php

/**
 * ORM config
 * 
 * @package Trial
 */

return [
	'users' => [
		'entity' => '\App\Entities\User',
		'relations' => [
			'oneToOne' => ['groups'],
			'field' => 'group_id'
		]
	],
	
	'pages' => [
		'entity' => '\App\Entities\Page',
		'relations' => [
			'oneToOne' => ['categories'],
			'field' => 'category_id'
		]
	],
	
	'categories' => [
		'entity' => '\App\Entities\Category',
		'relations' => [
			'hierarchical' => ['categories'],
			'field' => 'parent_id'
		]
	],
	
	'comments' => [
		'entity' => '\App\Entities\Comment',
		'relations' => [
			'oneToOneBinding' => [
				'comments',
				'pages',
				'categories',
				'users'
			]
		]
	],
	
	'groups' => [
		'entity' => '\App\Entities\Group'
	],
	
	'map' => [
		'\App\Entities\User' => 'users',
		'\App\Entities\Page' => 'pages',
		'\App\Entities\Category' => 'categories',
		'\App\Entities\Comment' => 'comment',
		'\App\Entities\Group' => 'groups'
	]
];