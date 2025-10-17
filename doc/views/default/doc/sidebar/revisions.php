<?php
/**
 * Doc sidebar menu showing revisions
 */

use Elgg\Database\Clauses\OrderByClause;

//If editing a post, show the previous revisions and drafts.
$doc = elgg_extract('entity', $vars, false);
if (!$doc instanceof ElggDoc) {
	return;
}

if (!$doc->canEdit()) {
	return;
}

/* @var ElggAnnotation[] $revisions */
$revisions = $doc->getAnnotations([
	'annotation_name' => 'doc_revision',
	'order_by' => [
		new OrderByClause('a_table.time_created', 'DESC'),
		new OrderByClause('a_table.id', 'DESC'),
	],
	'limit' => false,
]);

if (empty($revisions)) {
	return;
}

$load_base_url = elgg_generate_url('edit:object:doc', [
	'guid' => $doc->guid,
]);

// show the "published revision"
$published_item = '';
if ($doc->status == 'published') {
	$load = elgg_view_url($load_base_url, elgg_echo('status:published'));
	$time = elgg_format_element('span', ['class' => 'elgg-subtext'], elgg_view_friendly_time($doc->time_created));

	$published_item = elgg_format_element('li', [], "$load: $time");
}

$n = count($revisions);
$revisions_list = '';
foreach ($revisions as $revision) {
	$time = elgg_format_element('span', ['class' => 'elgg-subtext'], elgg_view_friendly_time($revision->time_created));
	
	$load = elgg_view_url("{$load_base_url}/{$revision->id}", elgg_echo('doc:revision') . " $n");

	$revisions_list .= elgg_format_element('li', ['class' => 'auto-saved'], "$load: $time");
	
	$n--;
}

$body = elgg_format_element('ul', ['class' => 'doc-revisions'], $published_item . $revisions_list);

echo elgg_view_module('aside', elgg_echo('doc:revisions'), $body);
