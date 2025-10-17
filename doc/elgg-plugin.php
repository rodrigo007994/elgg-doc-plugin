<?php

use Elgg\Doc\Forms\PrepareFields;
use Elgg\Doc\GroupToolContainerLogicCheck;
use Elgg\Doc\Notifications\PublishDocEventHandler;

return [
	'plugin' => [
		'name' => 'Doc',
		'activate_on_install' => true,
	],
	'entities' => [
		[
			'type' => 'object',
			'subtype' => 'doc',
			'class' => 'ElggDoc',
			'capabilities' => [
				'commentable' => true,
				'searchable' => true,
				'subscribable' => true,
				'likable' => true,
				'restorable' => true,
			],
		],
	],
	'actions' => [
		'doc/save' => [
			'controller' => \Elgg\Doc\Controllers\EditAction::class,
			'options' => [
				'entity_type' => 'object',
				'entity_subtype' => 'doc',
			],
		],
	],
	'routes' => [
		'collection:object:doc:owner' => [
			'path' => '/doc/owner/{username}/{lower?}/{upper?}',
			'resource' => 'doc/owner',
			'requirements' => [
				'lower' => '\d+',
				'upper' => '\d+',
			],
			'middleware' => [
				\Elgg\Router\Middleware\UserPageOwnerGatekeeper::class,
			],
		],
		'collection:object:doc:friends' => [
			'path' => '/doc/friends/{username}/{lower?}/{upper?}',
			'resource' => 'doc/friends',
			'requirements' => [
				'lower' => '\d+',
				'upper' => '\d+',
			],
			'required_plugins' => [
				'friends',
			],
			'middleware' => [
				\Elgg\Router\Middleware\UserPageOwnerGatekeeper::class,
			],
		],
		'view:object:doc' => [
			'path' => '/doc/view/{guid}/{title?}',
			'resource' => 'doc/view',
		],
		'add:object:doc' => [
			'path' => '/doc/add/{guid}',
			'resource' => 'doc/add',
			'middleware' => [
				\Elgg\Router\Middleware\Gatekeeper::class,
				\Elgg\Router\Middleware\PageOwnerGatekeeper::class,
			],
		],
		'edit:object:doc' => [
			'path' => '/doc/edit/{guid}/{revision?}',
			'resource' => 'doc/edit',
			'requirements' => [
				'revision' => '\d+',
			],
			'middleware' => [
				\Elgg\Router\Middleware\Gatekeeper::class,
			],
		],
		'collection:object:doc:group' => [
			'path' => '/doc/group/{guid}/{subpage?}/{lower?}/{upper?}',
			'resource' => 'doc/group',
			'defaults' => [
				'subpage' => 'all',
			],
			'requirements' => [
				'subpage' => 'all|archive',
				'lower' => '\d+',
				'upper' => '\d+',
			],
			'required_plugins' => [
				'groups',
			],
			'middleware' => [
				\Elgg\Router\Middleware\GroupPageOwnerGatekeeper::class,
			],
		],
		'collection:object:doc:all' => [
			'path' => '/doc/all/{lower?}/{upper?}',
			'resource' => 'doc/all',
			'requirements' => [
				'lower' => '\d+',
				'upper' => '\d+',
			],
		],
		'default:object:doc' => [
			'path' => '/doc',
			'resource' => 'doc/all',
		],
	],
	'events' => [
		'container_logic_check' => [
			'object' => [
				GroupToolContainerLogicCheck::class => [],
			],
		],
		'entity:url' => [
			'object:widget' => [
				'Elgg\Doc\Widgets::docWidgetUrl' => [],
			],
		],
		'form:prepare:fields' => [
			'doc/save' => [
				PrepareFields::class => [],
			],
		],
		'register' => [
			'menu:doc_archive' => [
				'Elgg\Doc\Menus\DocArchive::register' => [],
			],
			'menu:owner_block' => [
				'Elgg\Doc\Menus\OwnerBlock::registerUserItem' => [],
				'Elgg\Doc\Menus\OwnerBlock::registerGroupItem' => [],
			],
			'menu:site' => [
				'Elgg\Doc\Menus\Site::register' => [],
			],
		],
		'seeds' => [
			'database' => [
				'Elgg\Doc\Seeder::register' => [],
			],
		],
	],
	'widgets' => [
		'doc' => [
			'context' => ['profile', 'dashboard'],
		],
	],
	'group_tools' => [
		'doc' => [],
	],
	'notifications' => [
		'object' => [
			'doc' => [
				'publish' => PublishDocEventHandler::class,
				'mentions' => \Elgg\Notifications\MentionsEventHandler::class,
			],
		],
	],
];
