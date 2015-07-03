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
	// ACP Modules
	'ACP_MODELS'					=> 'Modèles de message',
	'ACP_MODELS_EXPLAIN'			=> 'Vous pouvez gérer les modèles de message que les utilisateurs autorisés pourront utiliser pour rédiger leurs messages.',

	// Admin logs
	'LOG_MODEL_ADDED'		=> '<strong>Ajout d’un modèle</strong><br />» %s',
	'LOG_MODEL_REMOVED'		=> '<strong>Suppression d’un modèle</strong><br />» %s',
	'LOG_MODEL_UPDATED'		=> '<strong>Mise à jour d’un modèle</strong><br />» %s',
));
