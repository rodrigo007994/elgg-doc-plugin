<?php

namespace Elgg\Doc;

use Elgg\Plugins\IntegrationTestCase;

class CanCommentIntegrationTest extends IntegrationTestCase {
	
	/**
	 * @dataProvider docCommentStatusProvider
	 */
	public function testCanComment($enable_comments, $status, $expected) {
		$doc = $this->createObject([
			'subtype' => 'doc',
			'comments_on' => $enable_comments,
			'status' => $status,
		]);
		
		$this->assertInstanceOf(\ElggDoc::class, $doc);
		$this->assertFalse($doc->canComment());
		
		$user = $this->createUser();
		
		_elgg_services()->session_manager->setLoggedInUser($user);
		
		$this->assertEquals($expected, $doc->canComment());
	}
	
	public static function docCommentStatusProvider() {
		return [
			['On', 'published', true],
			['On', 'draft', false],
			['Off', 'published', false],
			['Off', 'draft', false],
		];
	}
}
