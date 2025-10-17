<?php

use Elgg\Exceptions\Http\EntityPermissionsException;

$container = elgg_get_page_owner_entity();
if (!$container->canWriteToContainer(0, 'object', 'doc')) {
	throw new EntityPermissionsException();
}

elgg_push_collection_breadcrumbs('object', 'doc', $container);

echo elgg_view_page(elgg_echo('add:object:doc'), [
	'content' => elgg_view_form('doc/save', [
		'sticky_enabled' => true,
	]),
	'filter_id' => 'doc/edit',
]);
