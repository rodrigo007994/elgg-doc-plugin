<?php
/**
 * Extended class to override the time_created
 *
 * @property string $status      The published status of the doc post (published, draft)
 * @property string $comments_on Whether commenting is allowed (Off, On)
 * @property string $excerpt     An excerpt of the doc post used when displaying the post
 */
class ElggDoc extends ElggObject {

	/**
	 * {@inheritDoc}
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = 'doc';
	}

	/**
	 * {@inheritDoc}
	 */
	public function canComment(int $user_guid = 0): bool {
		if (!parent::canComment($user_guid)) {
			return false;
		}

		if ($this->comments_on === 'Off' || $this->status !== 'published') {
			return false;
		}
		
		return true;
	}

	/**
	 * Get the excerpt for this doc post
	 *
	 * @param int $length Length of the excerpt (optional)
	 * @return string
	 * @since 1.9.0
	 */
	public function getExcerpt(int $length = 250): string {
		$excerpt = $this->excerpt ?: $this->description;
		
		return elgg_get_excerpt((string) $excerpt, $length);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public static function getDefaultFields(): array {
		$result = parent::getDefaultFields();
		
		$result[] = [
			'#type' => 'text',
			'#label' => elgg_echo('title'),
			'name' => 'title',
			'required' => true,
			'id' => 'doc_title',
		];

		$result[] = [
			'#type' => 'text',
			'#label' => elgg_echo('doc:excerpt'),
			'name' => 'excerpt',
			'id' => 'doc_excerpt',
		];

		$result[] = [
			'#type' => 'longtext',
			'#label' => elgg_echo('doc:body'),
			'name' => 'description',
			'required' => true,
			'id' => 'doc_description',
		];

		$result[] = [
			'#type' => 'tags',
			'#label' => elgg_echo('tags'),
			'name' => 'tags',
			'id' => 'doc_tags',
		];
		
		$result[] = [
			'#type' => 'checkbox',
			'#label' => elgg_echo('comments'),
			'name' => 'comments_on',
			'id' => 'doc_comments_on',
			'default' => 'Off',
			'value' => 'On',
			'switch' => true,
		];
		
		$result[] = [
			'#type' => 'access',
			'#label' => elgg_echo('access'),
			'name' => 'access_id',
			'id' => 'doc_access_id',
			'entity_type' => 'object',
			'entity_subtype' => 'doc',
		];
		
		$result[] = [
			'#type' => 'select',
			'#label' => elgg_echo('status'),
			'name' => 'status',
			'id' => 'doc_status',
			'options_values' => [
				'draft' => elgg_echo('status:draft'),
				'published' => elgg_echo('status:published'),
			],
		];
		
		return $result;
	}
}
