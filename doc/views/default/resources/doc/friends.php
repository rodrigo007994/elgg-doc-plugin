<?php

$lower = elgg_extract('lower', $vars);
$upper = elgg_extract('upper', $vars);

$user = elgg_get_page_owner_entity();

elgg_push_collection_breadcrumbs('object', 'doc', $user, true);

elgg_register_title_button('add', 'object', 'doc');

$title = elgg_echo('collection:object:doc:friends');
if ($lower) {
	$title .= ': ' . elgg_echo('date:month:' . date('m', $lower), [date('Y', $lower)]);
}

$content = elgg_view('doc/listing/friends', [
	'entity' => $user,
	'created_after' => $lower,
	'created_before' => $upper,
]);

echo elgg_view_page($title, [
	'content' => $content,
	'sidebar' => elgg_view('doc/sidebar', [
		'page' => 'friends',
		'entity' => $user,
	]),
	'filter_value' => $user->guid === elgg_get_logged_in_user_guid() ? 'friends' : 'none',
]);
