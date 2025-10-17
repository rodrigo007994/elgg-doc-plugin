<?php
/**
 * List user docs
 *
 * Note: this view has a corresponding view in the default rss type, changes should be reflected
 *
 * @uses $vars['options']        Additional listing options
 * @uses $vars['entity']         User
 * @uses $vars['created_after']  Only show docs created after a date
 * @uses $vars['created_before'] Only show docs created before a date
 * @uses $vars['status']         Filter by status
 */

$options = (array) elgg_extract('options', $vars);
$entity = elgg_extract('entity', $vars);
if (!$entity instanceof \ElggUser) {
	return;
}

$owner_options = [
	'owner_guid' => $entity->guid,
	'preload_owners' => false,
];

$vars['options'] = array_merge($options, $owner_options);

echo elgg_view('doc/listing/all', $vars);
