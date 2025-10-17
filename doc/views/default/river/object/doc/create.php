<?php
/**
 * Doc river view.
 */

$item = elgg_extract('item', $vars);
if (!$item instanceof ElggRiverItem) {
	return;
}

$doc = $item->getObjectEntity();
if (!$doc instanceof ElggDoc) {
	return;
}

$vars['message'] = $doc->getExcerpt();

echo elgg_view('river/elements/layout', $vars);
