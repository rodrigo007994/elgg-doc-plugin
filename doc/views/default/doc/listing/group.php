<?php
/**
 * List group docs
 *
 * Note: this view has a corresponding view in the default rss type, changes should be reflected
 *
 * @uses $vars['options']        Additional listing options
 * @uses $vars['entity']         Group
 * @uses $vars['created_after']  Only show docs created after a date
 * @uses $vars['created_before'] Only show docs created before a date
 * @uses $vars['status']         Filter by status
 */

$options = (array) elgg_extract('options', $vars);
$entity = elgg_extract('entity', $vars);
if (!$entity instanceof \ElggGroup) {
	return;
}

$group_options = [
	'container_guid' => $entity->guid,
	'preload_containers' => false,
];

$vars['options'] = array_merge($options, $group_options);

echo elgg_view('doc/listing/all', $vars);
