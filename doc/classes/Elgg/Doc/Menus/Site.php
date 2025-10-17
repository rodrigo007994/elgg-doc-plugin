<?php

namespace Elgg\Doc\Menus;

/**
 * Event callbacks for menus
 *
 * @since 4.0
 * @internal
 */
class Site {

	/**
	 * Register item to menu
	 *
	 * @param \Elgg\Event $event 'register', 'menu:site'
	 *
	 * @return \Elgg\Menu\MenuItems
	 */
	public static function register(\Elgg\Event $event) {
		$return = $event->getValue();
		
		$return[] = \ElggMenuItem::factory([
			'name' => 'doc',
			'icon' => 'edit-regular',
			'text' => elgg_echo('collection:object:doc'),
			'href' => elgg_generate_url('default:object:doc'),
		]);
		
		return $return;
	}
}
