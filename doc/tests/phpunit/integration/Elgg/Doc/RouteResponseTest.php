<?php

namespace Elgg\Doc;

class RouteResponseTest extends \Elgg\Plugins\RouteResponseIntegrationTestCase {

	protected static function getSubtype() {
		return 'doc';
	}
	
	public static function groupRoutesProtectedByToolOption() {
		return [
			[
				'route' => 'collection:object:' . self::getSubtype() . ':group',
				'tool' => 'doc',
			],
		];
	}
}
