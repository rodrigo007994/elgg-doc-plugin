<?php

$guid = (int) elgg_extract('guid', $vars);
elgg_entity_gatekeeper($guid, 'object', 'doc');

$entity = get_entity($guid);

elgg_push_entity_breadcrumbs($entity);

echo elgg_view_page($entity->getDisplayName(), [
	'content' => elgg_view_entity($entity),
	'filter_id' => 'doc/view',
	'entity' => $entity,
	'sidebar' => elgg_view('object/doc/elements/sidebar', [
		'entity' => $entity,
	]),
]);
