<?php

namespace Elgg\Doc;

use Elgg\Database\Seeds\Seed;
use Elgg\Exceptions\Seeding\MaxAttemptsException;

/**
 * Add doc seed
 *
 * @internal
 */
class Seeder extends Seed {

	protected array $status = [
		'draft',
		'published',
	];

	/**
	 * {@inheritdoc}
	 */
	public function seed() {
		$this->advance($this->getCount());

		while ($this->getCount() < $this->limit) {
			try {
				/* @var $doc \ElggDoc */
				$doc = $this->createObject([
					'subtype' => 'doc',
					'status' => $this->getRandomStatus(),
					'comments_on' => $this->faker()->boolean() ? 'On' : 'Off',
					'excerpt' => $this->faker()->sentence(),
				]);
			} catch (MaxAttemptsException $e) {
				// unable to create a doc with the given options
				continue;
			}

			$this->createComments($doc);
			$this->createLikes($doc);

			if ($doc->status === 'draft') {
				$doc->future_access = $doc->access_id;
				$doc->access_id = ACCESS_PRIVATE;
			}

			if ($doc->status === 'published') {
				elgg_create_river_item([
					'view' => 'river/object/doc/create',
					'action_type' => 'create',
					'subject_guid' => $doc->owner_guid,
					'object_guid' => $doc->guid,
					'target_guid' => $doc->container_guid,
					'posted' => $doc->time_created,
				]);

				elgg_trigger_event('publish', 'object', $doc);
			}

			if ($this->faker()->boolean()) {
				$doc->annotate('doc_revision', $doc->description, ACCESS_PRIVATE, $doc->owner_guid);
				$doc->description = $this->faker()->text(500);
			}

			$doc->save();

			$this->advance();
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function unseed() {
		/* @var $docs \ElggBatch */
		$docs = elgg_get_entities([
			'type' => 'object',
			'subtype' => 'doc',
			'metadata_name' => '__faker',
			'limit' => false,
			'batch' => true,
			'batch_inc_offset' => false,
		]);

		/* @var $doc \ElggDoc */
		foreach ($docs as $doc) {
			if ($doc->delete()) {
				$this->log("Deleted doc {$doc->guid}");
			} else {
				$this->log("Failed to delete doc {$doc->guid}");
				$docs->reportFailure();
				continue;
			}

			$this->advance();
		}
	}

	/**
	 * {@inheritDoc}
	 */
	public static function getType() : string {
		return 'doc';
	}

	/**
	 * Returns random doc status
	 *
	 * @return string
	 */
	public function getRandomStatus(): string {
		$key = array_rand($this->status);

		return $this->status[$key];
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function getCountOptions() : array {
		return [
			'type' => 'object',
			'subtype' => 'doc',
		];
	}
}
