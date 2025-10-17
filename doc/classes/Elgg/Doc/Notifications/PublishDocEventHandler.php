<?php

namespace Elgg\Doc\Notifications;

use Elgg\Notifications\NotificationEventHandler;

/**
 * Notification Event Handler for 'object' 'doc' 'publish' action
 */
class PublishDocEventHandler extends NotificationEventHandler {

	/**
	 * {@inheritdoc}
	 */
	protected function getNotificationSubject(\ElggUser $recipient, string $method): string {
		return elgg_echo('doc:notify:subject', [$this->getEventEntity()?->getDisplayName()]);
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getNotificationSummary(\ElggUser $recipient, string $method): string {
		return elgg_echo('doc:notify:summary', [$this->getEventEntity()?->getDisplayName()]);
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getNotificationBody(\ElggUser $recipient, string $method): string {
		$entity = $this->getEventEntity();
		if (!$entity instanceof \ElggDoc) {
			$entity = null;
		}
		
		return elgg_echo('doc:notify:body', [
			$this->getEventActor()?->getDisplayName(),
			$entity?->getDisplayName(),
			$entity?->getExcerpt(),
			$entity?->getURL(),
		]);
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected static function isConfigurableForGroup(\ElggGroup $group): bool {
		return $group->isToolEnabled('doc');
	}
}
