<?php

use Elgg\Exceptions\Http\EntityNotFoundException;

$guid = (int) elgg_extract('guid', $vars);
elgg_entity_gatekeeper($guid, 'object', 'doc', true);

/* @var $doc \ElggDoc */
$doc = get_entity($guid);

$vars['entity'] = $doc;

elgg_push_entity_breadcrumbs($doc);

$revision_id = (int) elgg_extract('revision', $vars);
$revision = null;

$title = elgg_echo('edit:object:doc');

if (!empty($revision_id)) {
	$revision = elgg_get_annotation_from_id($revision_id);
	$vars['revision'] = $revision;
	$title .= ' ' . elgg_echo('doc:edit_revision_notice');

	if (!$revision instanceof \ElggAnnotation || $revision->entity_guid !== $guid) {
		// @todo replace this with a PageNotFoundException in 7.0
		throw new EntityNotFoundException(elgg_echo('doc:error:revision_not_found'));
	}
}

$form_vars = [
	'sticky_enabled' => true,
];

$body_vars = [
	'entity' => $doc,
	'revision' => $revision,
];

echo elgg_view_page($title, [
	'content' => elgg_view_form('doc/save', $form_vars, $body_vars),
	'sidebar' => elgg_view('doc/sidebar/revisions', $vars),
	'filter_id' => 'doc/edit',
]);
