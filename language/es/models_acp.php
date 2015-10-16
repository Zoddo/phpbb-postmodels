<?php
/**
 *
 * @package Post Models Extension
 * @copyright (c) 2015 Zoddo <zoddo.ino@gmail.com>
 * @copyright (c) 2007 Elglobo <http://www.phpbb-services.com>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}


// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'ADD_NEW_MODEL'			=> 'Añadir nuevo modelo de mensaje',
	'FOUNDERS'				=> 'Fundadores',
	'MODEL'					=> 'Modelo',
	'MODEL_ADD'				=> 'Añadir modelo de mensaje',
	'MODEL_ADDED'			=> 'Modelo de mensaje añadido correctamente.',
	'MODEL_AUTH'			=> 'Permiso de modelo',
	'MODEL_AUTH_EXPLAIN'	=> 'Definir el permiso necesario para ver este modelo. <br />Tendrá también que autorizar a los usuarios el poder utilizar modelos de mensajes estableciendo el permiso adecuado.',
	'MODEL_ALREADY_EXIST'	=> 'Ya existe un modelo con este título, por favor, introduzca título para este modelo.',
	'MODEL_CONTENT'			=> 'Contenido del modelo',
	'MODEL_CONTENT_EXPLAIN'	=> 'El contenido del modelo se insertará como en el cuerpo del mensaje',
	'MODEL_EDIT'			=> 'Editar modelo de mensaje',
	'MODEL_EDIT_EXPLAIN'	=> 'Aquí puede añadir o editar un modelo de mensaje.',
	'MODEL_LANGUAGE'		=> 'Idioma del modelo',
	'MODEL_PM'				=> 'Mostrar en mensajería privada',
	'MODEL_PM_EXPLAIN'		=> 'Tendrá también que autorizar a los usuarios el poder utilizar modelos de mensajes en la mensajería privada estableciendo el permiso adecuado.',
	'MODEL_SETTINGS'		=> 'Ajustes del modelo',
	'MODEL_TITLE'			=> 'Nombre del modelo',
	'MODEL_UPDATED'			=> 'Modelo de mensaje actualizado correctamente.',
	'MODEL_REMOVED'			=> 'Modelo de mensaje borrado correctamente.',

	'NO_EXIST'				=> 'El paquete de idioma ya no está disponible.',
	'NO_MODEL_INFO'			=> 'Debe especificar un título, un contenido, y un idioma para su modelo.',
	'NO_MODEL'				=> 'No se pudo encontar el modelo de mensaje.',
	'NO_PERMISSIONS'		=> 'No dispone del permiso necesario para gestionar modelos de mensajes.',
));
