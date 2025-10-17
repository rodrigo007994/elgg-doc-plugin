/**
 * Doc save form
 */

import 'jquery';
import Ajax from 'elgg/Ajax';

// preview button clicked
$(document).on('click', '.elgg-form-doc-save button[name="preview"]', function(event) {
	event.preventDefault();
	
	var $form = $(this).closest('form');
	if (!$form[0].checkValidity()) {
		return false;
	}
	
	var ajax = new Ajax();
	var formData = ajax.objectify('form.elgg-form-doc-save');
	
	// tell the action this a preview save
	formData.append('preview', 1);
	
	// open preview in blank window
	ajax.action('doc/save', {
		data: formData,
		success: function(data) {
			$('form.elgg-form-doc-save').find('input[name=guid]').val(data.guid);
			window.open(data.url, '_blank').focus();
		}
	});
});
