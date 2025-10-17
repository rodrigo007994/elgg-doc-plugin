<?php
/**
 * Edit doc form
 */

elgg_import_esm('forms/doc/save');

$doc = elgg_extract('entity', $vars);

echo elgg_view('entity/edit/header', [
	'entity' => $doc,
	'entity_type' => 'object',
	'entity_subtype' => 'doc',
]);

$fields = elgg()->fields->get('object', 'doc');
foreach ($fields as $field) {
	$name = elgg_extract('name', $field);
	
	switch (elgg_extract('#type', $field)) {
		case 'checkbox':
			$value = elgg_extract('value', $field);
			$field['checked'] = isset($value) ? $value === elgg_extract($name, $vars) : null;
			break;
		case 'access':
			if ($doc instanceof \ElggDoc) {
				$field['entity'] = $doc;
			}
			
			// fall through to set value
		default:
			$field['value'] = elgg_extract($name, $vars);
			break;
	}
	
	echo elgg_view_field($field);
}

echo elgg_view_field([
	'#type' => 'hidden',
	'name' => 'guid',
	'value' => $doc?->guid,
]);

echo elgg_view_field([
	'#type' => 'container_guid',
	'value' => elgg_extract('container_guid', $vars),
	'entity_type' => 'object',
	'entity_subtype' => 'doc',
]);

$saved = $doc instanceof \ElggDoc ? elgg_view('output/friendlytime', ['time' => $doc->time_updated]) : elgg_echo('never');
$saved = elgg_format_element('span', ['class' => 'doc-save-status-time'], $saved);

$footer = elgg_format_element('div', ['class' => ['elgg-subtext', 'mbm']], elgg_echo('doc:save_status') . ' ' . $saved);

$buttons = [];
$buttons[] = [
	'#type' => 'submit',
	'name' => 'save',
	'value' => 1,
	'text' => elgg_echo('save'),
];

// published docs do not get the preview button
if (!$doc instanceof \ElggDoc || $doc->status != 'published') {
	$buttons[] = [
		'#type' => 'button',
		'name' => 'preview',
		'value' => 1,
		'text' => elgg_echo('preview'),
		'class' => 'elgg-button-action',
	];
}

$footer .= elgg_view_field([
	'#type' => 'fieldset',
	'align' => 'horizontal',
	'fields' => $buttons,
]);

elgg_set_form_footer($footer);
