<?php

namespace Elgg\Doc\Forms;

/**
 * Prepare the fields for the doc/save form
 *
 * @since 5.0
 */
class PrepareFields {
	
	/**
	 * Prepare fields
	 *
	 * @param \Elgg\Event $event 'form:prepare:fields', 'doc/save'
	 *
	 * @return array
	 */
	public function __invoke(\Elgg\Event $event): array {
		$vars = $event->getValue();
		
		// input names => defaults
		$values = [
			'container_guid' => elgg_get_page_owner_guid(),
		];
		
		$fields = elgg()->fields->get('object', 'doc');
		foreach ($fields as $field) {
			$default_value = null;
			$name = (string) elgg_extract('name', $field);
			
			if ($name === 'status') {
				$default_value = 'published';
			} elseif ($name === 'comments_on') {
				$default_value = 'On';
			}
			
			$values[$name] = $default_value;
		}
		
		$doc = elgg_extract('entity', $vars);
		if ($doc instanceof \ElggDoc) {
			// load current doc values
			foreach (array_keys($values) as $field) {
				if (isset($doc->{$field})) {
					$values[$field] = $doc->{$field};
				}
			}
			
			if ($doc->status == 'draft') {
				$values['access_id'] = $doc->future_access;
			}
			
			// load the revision annotation if requested
			$revision = elgg_extract('revision', $vars);
			if ($revision instanceof \ElggAnnotation && $revision->entity_guid == $doc->guid) {
				$values['revision'] = $revision;
				$values['description'] = $revision->value;
			}
		}
		
		return array_merge($values, $vars);
	}
}
