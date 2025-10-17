<?php
/**
 * Translation file
 *
 * Note: don't change the return array to short notation because Transifex can't handle those during `tx push -s`
 */

return array(
	'item:object:doc' => 'Doc',
	'collection:object:doc' => 'Docs',
	
	'collection:object:doc:all' => 'Todos los documentos',
	'collection:object:doc:owner' => 'Documentos de %s',
	'collection:object:doc:group' => 'Documentos de grupo',
	'collection:object:doc:friends' => 'Documentos de amigos',
	'add:object:doc' => 'Añadir una entrada al documento',
	'edit:object:doc' => 'Editar entrada del documento',

	'doc:revisions' => 'Revisiones',
	'doc:archives' => 'Archivos',

	'groups:tool:doc' => 'Activar doc de grupo',

	// Editing
	'doc:excerpt' => 'Extracto',
	'doc:body' => 'Cuerpo',
	'doc:save_status' => '&Uacute;ltimo guardado: ',

	'doc:revision' => 'Revisi&oacute;n',
	
	// messages
	'doc:message:saved' => 'Entrada guardada.',
	'doc:error:cannot_save' => 'No se puede guardar el documento.',
	'doc:error:cannot_write_to_container' => 'Acceso insuficiente para guardar el documento.',
	'doc:edit_revision_notice' => '(Versi&oacute;n antigua)',
	'doc:none' => 'No hay entradas', // @todo remove in Elgg 7.0
	'doc:error:missing:title' => '¡Por favor ingresa un t&iacute;tulo!',
	'doc:error:missing:description' => '¡Por favor ingresa contenidos!',
	'doc:error:post_not_found' => 'No se puede encontrar el documentos especificado.',
	'doc:error:revision_not_found' => 'No se puede encontrar esta revisi&oacute;n.',

	// river
	'river:object:doc:create' => '%s Publico una entrada de documento %s',
	'river:object:doc:comment' => '%s Comento en el documento %s',

	// notifications
	'doc:notify:summary' => 'Nueva entrada en el documento llamado: %s',
	'doc:notify:subject' => 'Nuevo documento: %s',

	// widget
	'widgets:doc:name' => 'Entradas del documento',
	'widgets:doc:description' => 'Mostrar tus ultimas entradas del documento',
	'doc:moredocs' => 'M&aacute;s entradas',
	'doc:numbertodisplay' => 'N&uacute;mero de entradas a mostrar',
);
