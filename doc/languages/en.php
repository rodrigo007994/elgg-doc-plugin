<?php
/**
 * Translation file
 *
 * Note: don't change the return array to short notation because Transifex can't handle those during `tx push -s`
 */

return array(
	'item:object:doc' => 'Doc',
	'collection:object:doc' => 'Docs',
	'list:object:doc:no_results' => 'No docs found',
	
	'collection:object:doc:all' => 'All site docs',
	'collection:object:doc:owner' => '%s\'s docs',
	'collection:object:doc:group' => 'Group docs',
	'collection:object:doc:friends' => 'Friends\' docs',
	'add:object:doc' => 'Add doc post',
	'edit:object:doc' => 'Edit doc post',
	
	'notification:object:doc:publish' => "Send a notification when a doc is published",
	'notifications:mute:object:doc' => "about the doc '%s'",
	'menu:doc_archive:header' => "Doc archive",
	
	'entity:edit:object:doc:success' => 'The doc was saved successfully',

	'doc:revisions' => 'Revisions',
	'doc:archives' => 'Archives',

	'groups:tool:doc' => 'Enable group doc',
	'groups:tool:doc:description' => 'Allow group members to write docs in this group.',

	// Editing
	'doc:excerpt' => 'Excerpt',
	'doc:body' => 'Body',
	'doc:save_status' => 'Last saved: ',

	'doc:revision' => 'Revision',
	
	// messages
	'doc:message:saved' => 'Doc post saved.',
	'doc:error:cannot_save' => 'Cannot save doc post.',
	'doc:error:cannot_write_to_container' => 'Insufficient access to save doc to group.',
	'doc:edit_revision_notice' => '(Old version)',
	'doc:none' => 'No doc posts', // @todo remove in Elgg 7.0
	'doc:error:missing:title' => 'Please enter a doc title!',
	'doc:error:missing:description' => 'Please enter the body of your doc!',
	'doc:error:post_not_found' => 'Cannot find specified doc post.',
	'doc:error:revision_not_found' => 'Cannot find this revision.',

	// river
	'river:object:doc:create' => '%s published a doc post %s',
	'river:object:doc:comment' => '%s commented on the doc %s',

	// notifications
	'doc:notify:summary' => 'New doc post called %s',
	'doc:notify:subject' => 'New doc post: %s',
	'doc:notify:body' => '%s published a new doc post: %s

%s

View and comment on the doc post:
%s',
	
	'notification:mentions:object:doc:subject' => '%s mentioned you in a doc post',

	// widget
	'widgets:doc:name' => 'Doc posts',
	'widgets:doc:description' => 'Display your latest doc posts',
	'doc:moredocs' => 'More doc posts',
	'doc:numbertodisplay' => 'Number of doc posts to display',
);
