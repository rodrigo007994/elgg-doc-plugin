<?php
/**
 * Group doc module
 */

$params = [
	'entity_type' => 'object',
	'entity_subtype' => 'doc',
];
$params = $params + $vars;

echo elgg_view('groups/profile/module', $params);
