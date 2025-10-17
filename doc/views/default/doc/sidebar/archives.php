<?php
/**
 * Doc archives
 */

$content = elgg_view_menu('doc_archive', [
	'page' => elgg_extract('page', $vars),
	'entity' => elgg_extract('entity', $vars, elgg_get_page_owner_entity()),
	'class' => 'elgg-menu-page',
	'show_doc_archive' => elgg_extract('show_doc_archive', $vars),
	'doc_archive_options' => elgg_extract('doc_archive_options', $vars),
	'doc_archive_url' => elgg_extract('doc_archive_url', $vars),
]);

if (!$content) {
	return;
}

echo elgg_view_module('aside', elgg_echo('doc:archives'), $content);
