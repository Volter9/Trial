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
			'type' => 'oneToOne',
			'table' => 'groups',
			'field' => 'group_id'
		]
	],
	
	'pages' => [
		'entity' => '\App\Entities\Page',
		'relations' => [
			'type' => 'multiple',
			'tables' => [
				'categories' => [
					'type' => 'oneToOne',
					'table' => 'categories',
					'field' => 'category_id'
				],
				'users' => [
					'type' => 'oneToOne',
					'table' => 'users',
					'field' => 'user_id'
				]
			]
		]
	],
	
	'categories' => [
		'entity' => '\App\Entities\Category',
		'relations' => [
			'type' => 'hierarchical',
			'table' => 'categories',
			'field' => 'parent_id'
		]
	],
	
	'comments' => [
		'entity' => '\App\Entities\Comment',
		'relations' => [
			'type' => 'oneToOneBinding',
			'tables' => [
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
	
	/**
	 * Types of relation available
	 */
	'relations' => [
		'oneToOne' => '\Trial\DB\ORM\Relations\OneToOne',
		'oneToOneBinding' => '\Trial\DB\ORM\Relations\OneToOneBinding',
		'hierarchical' => '\Trial\DB\ORM\Relations\Hierarchical',
		'multiple' => '\Trial\DB\ORM\Relations\Multiple'
	]
];