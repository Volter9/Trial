<?php

/**
 * Mapper's config
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
		'mapper' => '\App\Mappers\Pages',
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
		'mapper' => '\App\Mappers\Categories'
	],
	
	'comments' => [
		'entity' => '\App\Entities\Comment',
		'mapper' => '\App\Mapper\Comments',
	],
	
	'groups' => [
		'entity' => '\App\Entities\Group'
	],
	
	/**
	 * Types of relation available
	 */
	'relations' => [
		'oneToOne' => '\Trial\DB\ORM\Relations\OneToOne',
		'hierarchical' => '\Trial\DB\ORM\Relations\Hierarchical',
		'multiple' => '\Trial\DB\ORM\Relations\Multiple'
	]
];