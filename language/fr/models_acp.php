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
	'ADD_NEW_MODEL'			=> 'Ajouter un nouveau modèle de message',
	'FOUNDERS'				=> 'Fondateurs',
	'MODEL'					=> 'Titre du modèle',
	'MODEL_ADD'				=> 'Ajouter un modèle de message',
	'MODEL_ADDED'			=> 'Le modèle de message a été ajouté.',
	'MODEL_AUTH'			=> 'Permission du modèle',
	'MODEL_AUTH_EXPLAIN'	=> 'Détermine la permission requise pour voir ce modèle. <br />Vous devrez également autoriser les utilisateurs à utiliser les modèles de message en réglant la permission adéquate.',
	'MODEL_ALREADY_EXIST'	=> 'Un modèle existe déjà avec ce titre, entrez un autre titre pour ce modèle.',
	'MODEL_CONTENT'			=> 'Contenu du modèle',
	'MODEL_CONTENT_EXPLAIN'	=> 'Le contenu du modèle sera inséré tel quel dans le corps du message',
	'MODEL_EDIT'			=> 'Editer le modèle de message',
	'MODEL_EDIT_EXPLAIN'	=> 'Vous pouvez ajouter ou éditer un modèle de message.',
	'MODEL_LANGUAGE'		=> 'Langue du modèle',
	'MODEL_PM'				=> 'Afficher dans la messagerie privée',
	'MODEL_PM_EXPLAIN'		=> 'Vous devrez également autoriser les utilisateurs à utiliser les modèles de message dans la messagerie privée en réglant la permission adéquate.',
	'MODEL_SETTINGS'		=> 'Options du modèle',
	'MODEL_TITLE'			=> 'Titre du modèle',
	'MODEL_UPDATED'			=> 'Le modèle de message a été mis à jour.',
	'MODEL_REMOVED'			=> 'Le modèle de message a été supprimé.',

	'NO_EXIST'				=> 'Le pack de langue n’est plus disponible.',
	'NO_MODEL_INFO'			=> 'Vous devez indiquer un titre, un contenu et une langue pour votre modèle.',
	'NO_MODEL'				=> 'La modèle de message est introuvable.',
	'NO_PERMISSIONS'		=> 'Vous n’avez pas la permission requise pour gérer les modèles de message.',
));
