<?php
/**
 * Doc sidebar
 */

$page = elgg_extract('page', $vars);

$entity = elgg_extract('entity', $vars, elgg_get_page_owner_entity());

echo elgg_view('doc/sidebar/archives', $vars);

if ($page !== 'friends') {
// fetch & display latest comments
	echo elgg_view('page/elements/comments_block', [
		'subtypes' => 'doc',
		'container_guid' => $entity ? $entity->guid : null,
	]);

	echo elgg_view('page/elements/tagcloud_block', [
		'subtypes' => 'doc',
		'container_guid' => $entity ? $entity->guid : null,
	]);
}
