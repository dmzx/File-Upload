<?php
/**
*
* @package phpBB Extension - File Upload
* @copyright (c) 2017 dmzx - https://www.dmzx-web.net & martin - https://www.martins-phpbb.com
* Nederlandse vertaling @ Solidjeuh <https://www.froddelpower.be>
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
	'FILEUPLOAD_UPLOAD'						=> 'Bestand-Upload',
	'FILEUPLOAD_UPLOAD_SECTION'				=> 'Bestand Upload sectie',
	'FILEUPLOAD_UPLOAD_MESSAGE'				=> 'Upload je bestand hier. (Let op: deze folder wordt leeggemaakt, en alle bestanden worden gelogd)',
	'FILEUPLOAD_NOT_ENABELD'					=> 'Bestand Upload is niet ingeschakeld',
	'FILEUPLOAD_NEW_DOWNLOAD_SIZE'				=> 'De maximum grootte van het bestand is <strong>%1$s %2$s</strong>! Door de upload tijd die het kan nodig hebben kan deze waarde lager zijn!',
	'FILEUPLOAD_NO_FILENAME'					=> 'Je moet een bestand opgeven dat behoort tot je upload!',
	'FILEUPLOAD_FILE_TOO_BIG'					=> 'Het bestand is groter dan dat je host toelaat!',
	'FILEUPLOAD_NEW_ADDED'						=> 'Je opgave werd succesvol toegevoegd aan de database.',
	'FILEUPLOAD_CURRENT_VERSION'				=> 'Versie',
	'FILEUPLOAD_NEW_FILENAME'					=> 'Bestandsnaam',
	'FILEUPLOAD_SUCCEEDED'						=> 'Upload Gelukt!',
	'FILEUPLOAD_DIRECT_LINK'					=> 'Directe link',
	'FILEUPLOAD_URL_LINK'						=> 'URL',
	'FILEUPLOAD_FILE_LINK'						=> 'BESTAND',
	'FILEUPLOAD_BY'							=> 'Bestand geupload door',
));
