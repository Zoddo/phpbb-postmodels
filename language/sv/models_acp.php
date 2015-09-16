<?php
/**
 *
 * @package Post Models Extension
 * @copyright (c) 2015 Zoddo <zoddo.ino@gmail.com>
 * @copyright (c) 2007 Elglobo <http://www.phpbb-services.com>
 * @Swedish translation by Holger (https://www.maskinisten.net)
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
	'ADD_NEW_MODEL'			=> 'Skapa en ny inläggsmall',
	'FOUNDERS'				=> 'Grundare',
	'MODEL'					=> 'Mall',
	'MODEL_ADD'				=> 'Skapa inläggsmall',
	'MODEL_ADDED'			=> 'Inläggsmall har skapats.',
	'MODEL_AUTH'			=> 'Behörighet för inläggsmall',
	'MODEL_AUTH_EXPLAIN'	=> 'Ställ in önskad behörighet för denna inläggsmall.<br />Du måste även ställa in korrekt (generell) behörighet för användning av inläggsmallar i inlägg.',
	'MODEL_ALREADY_EXIST'	=> 'En mall med denna rubrik existerar redan, använd en annan rubrik.',
	'MODEL_CONTENT'			=> 'Mallens innehåll',
	'MODEL_CONTENT_EXPLAIN'	=> 'Mallens innehåll kommer att infogas i inlägget',
	'MODEL_EDIT'			=> 'Ändra inläggsmall',
	'MODEL_EDIT_EXPLAIN'	=> 'Här kan du skapa eller ändra inläggsmallar.',
	'MODEL_LANGUAGE'		=> 'Språk för inläggsmallen',
	'MODEL_PM'				=> 'Visa i privata meddelanden',
	'MODEL_PM_EXPLAIN'		=> 'Du måste även ställa in korrekt (generell) behörighet för användning av inläggsmallar i privata meddelanden.',
	'MODEL_SETTINGS'		=> 'Inställningar för inläggsmall',
	'MODEL_TITLE'			=> 'Inläggsmallens beteckning',
	'MODEL_UPDATED'			=> 'Inläggsmallen har aktualiserats.',
	'MODEL_REMOVED'			=> 'Inläggsmallen har raderats.',

	'NO_EXIST'				=> 'Språkpaketet existerar inte längre.',
	'NO_MODEL_INFO'			=> 'Du måste ange en beteckning, innehåll och språk för mallen.',
	'NO_MODEL'				=> 'Inläggsmallen kunde ej hittas.',
	'NO_PERMISSIONS'		=> 'Du är ej behörig att hantera inläggsmallar.',
));
