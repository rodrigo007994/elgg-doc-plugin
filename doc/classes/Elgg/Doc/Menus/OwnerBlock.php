<?php

namespace Elgg\Doc\Menus;

/**
 * Event callbacks for menus
 *
 * @since 4.0
 * @internal
 */
class OwnerBlock {

	/**
	 * Register user item to menu
	 *
	 * @param \Elgg\Event $event 'register', 'menu:owner_block'
	 *
	 * @return void|\Elgg\Menu\MenuItems
	 */
	public static function registerUserItem(\Elgg\Event $event) {
		$entity = $event->getEntityParam();
		if (!$entity instanceof \ElggUser) {
			return;
		}
		
		$return = $event->getValue();
		
		$return[] = \ElggMenuItem::factory([
			'name' => 'doc',
			'text' => elgg_echo('collection:object:doc'),
			'href' => elgg_generate_url('collection:object:doc:owner', [
				'username' => $entity->username,
			]),
		]);
		
		return $return;
	}

	/**
	 * Register group item to menu
	 *
	 * @param \Elgg\Event $event 'register', 'menu:owner_block'
	 *
	 * @return void|\Elgg\Menu\MenuItems
	 */
	public static function registerGroupItem(\Elgg\Event $event) {
		$entity = $event->getEntityParam();
		if (!$entity instanceof \ElggGroup) {
			return;
		}
		
		if (!$entity->isToolEnabled('doc')) {
			return;
		}
		
		$return = $event->getValue();
	
		$return[] = \ElggMenuItem::factory([
			'name' => 'doc',
			'text' => elgg_echo('collection:object:doc:group'),
			'href' => elgg_generate_url('collection:object:doc:group', [
				'guid' => $entity->guid,
				'subpage' => 'all',
			]),
		]);
		
		return $return;
	}
}
