<?php

namespace Elgg\Doc;

/**
 * Widget related functions
 */
class Widgets {
	
	/**
	 * Set the URL for the doc widget
	 *
	 * @param \Elgg\Event $event 'entity:url', 'object:widget'
	 *
	 * @return null|string
	 */
	public static function docWidgetUrl(\Elgg\Event $event): ?string {
		if (!empty($event->getValue())) {
			// url already provided
			return null;
		}
		
		$widget = $event->getEntityParam();
		if (!$widget instanceof \ElggWidget || $widget->handler !== 'doc') {
			return null;
		}
		
		$owner = $widget->getOwnerEntity();
		if ($owner instanceof \ElggGroup) {
			return elgg_generate_url('collection:object:doc:group', [
				'guid' => $owner->guid,
			]);
		} elseif ($owner instanceof \ElggUser) {
			return elgg_generate_url('collection:object:doc:owner', [
				'username' => $owner->username,
			]);
		}
		
		return elgg_generate_url('collection:object:doc:all');
	}
}
