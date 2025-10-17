<?php

$lower = elgg_extract('lower', $vars);
$upper = elgg_extract('upper', $vars);

elgg_group_tool_gatekeeper('doc');

$group = elgg_get_page_owner_entity();

elgg_register_title_button('add', 'object', 'doc');

elgg_push_collection_breadcrumbs('object', 'doc', $group);

$title = elgg_echo('collection:object:doc:group');
if ($lower) {
	$title .= ': ' . elgg_echo('date:month:' . date('m', $lower), [date('Y', $lower)]);
}

$content = elgg_view('doc/listing/group', [
	'entity' => $group,
	'created_after' => $lower,
	'created_before' => $upper,
]);

echo elgg_view_page($title, [
	'content' => $content,
	'sidebar' => elgg_view('doc/sidebar', [
		'page' => 'group',
		'entity' => $group,
	]),
	'filter_id' => 'doc/group',
	'filter_value' => 'all',
]);
