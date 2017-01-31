<?php
/**
*
* @package phpBB Extension - File Upload
* @copyright (c) 2017 dmzx - http://www.dmzx-web.net
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
	'FILEUPLOAD_UPLOAD'						=> 'Datei-Upload',
	'FILEUPLOAD_UPLOAD_SECTION'				=> 'Datei-Upload-Bereich',
	'FILEUPLOAD_UPLOAD_MESSAGE'				=> 'Lade deine Dateien hier hoch. (Beachte, dass dieser Ordner geleert wird, und alle Uploads werden protokolliert)',
	'FILEUPLOAD_NOT_ENABELD'					=> 'Datei-Upload ist nicht aktiviert',
	'FILEUPLOAD_NEW_DOWNLOAD_SIZE'				=> 'Die maximale Dateigröße beträgt <strong>%1$s %2$s</strong>! Abhängig von der Zeit, die zum Hochladen benötigt wird, kann dieser Wert niedriger sein!',
	'FILEUPLOAD_NO_FILENAME'					=> 'Du musst eine Datei für deinen Upload auswählen!',
	'FILEUPLOAD_FILE_TOO_BIG'					=> 'Die Datei ist größer als dein Hoster erlaubt!',
	'FILEUPLOAD_NEW_ADDED'						=> 'Dein Eintrag wurde erfolgreich in der Datenbank gespeichert',
	'FILEUPLOAD_CURRENT_VERSION'				=> 'Version',
	'FILEUPLOAD_NEW_FILENAME'					=> 'Dateiname',
	'FILEUPLOAD_SUCCEEDED'						=> 'Upload erfolgreich!',
	'FILEUPLOAD_DIRECT_LINK'					=> 'Direkter Link',
	'FILEUPLOAD_URL_LINK'						=> 'URL',
	'FILEUPLOAD_FILE_LINK'						=> 'Datei',
	'FILEUPLOAD_BY'							=> 'Datei hochgeladen von',
));
