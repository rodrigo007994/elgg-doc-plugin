<?php

namespace Elgg\Doc;

use Elgg\Groups\ToolContainerLogicCheck;

/**
 * Prevent docs from being created if the group tool option is disabled
 */
class GroupToolContainerLogicCheck extends ToolContainerLogicCheck {

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
	public function getToolName(): string {
		return 'doc';
	}
}
