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
	'ADD_NEW_MODEL'			=> 'Add new post model',
	'FOUNDERS'				=> 'Founders',
	'MODEL'					=> 'Model',
	'MODEL_ADD'				=> 'Add post model',
	'MODEL_ADDED'			=> 'Post model successfully added.',
	'MODEL_AUTH'			=> 'Model permission',
	'MODEL_AUTH_EXPLAIN'	=> 'Define the required permission to view this model. <br />You will have to also authorize users to use post models by setting the appropriate permission.',
	'MODEL_ALREADY_EXIST'	=> 'A model with this title already exist, please enter another title for this model.',
	'MODEL_CONTENT'			=> 'Model content',
	'MODEL_CONTENT_EXPLAIN'	=> 'The model content will be inserted such as it in the message body',
	'MODEL_EDIT'			=> 'Edit post model',
	'MODEL_EDIT_EXPLAIN'	=> 'Here you are able to add or edit a post model.',
	'MODEL_LANGUAGE'		=> 'Model language',
	'MODEL_PM'				=> 'Display in private messaging',
	'MODEL_PM_EXPLAIN'		=> 'You will have to also authorize users to use post models in private messaging by setting the appropriate permission.',
	'MODEL_SETTINGS'		=> 'Model settings',
	'MODEL_TITLE'			=> 'Model name',
	'MODEL_UPDATED'			=> 'Post model successfully updated.',
	'MODEL_REMOVED'			=> 'Post model successfully removed.',

	'NO_EXIST'				=> 'The language pack is no longer available.',
	'NO_MODEL_INFO'			=> 'You must specify a title, a content and a language for your model.',
	'NO_MODEL'				=> 'Post model could not be found.',
	'NO_PERMISSIONS'		=> 'You don’t have the required permission to manage post models.',
));
