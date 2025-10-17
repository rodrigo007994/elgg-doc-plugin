<?php

namespace Elgg\Doc;

use Elgg\Plugins\GroupToolContainerLogicIntegrationTestCase;

class GroupToolContainerLogicIntegrationTest extends GroupToolContainerLogicIntegrationTestCase {

	/**
	 * {@inheritDoc}
	 */
	public function getContentType(): string {
		return 'object';
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function getContentSubtype(): string {
		return 'doc';
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function getGroupToolOption(): string {
		return 'doc';
	}
}
