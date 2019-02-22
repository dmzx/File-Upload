<?php
/**
*
* @package phpBB Extension - File Upload
* @copyright (c) 2017 dmzx - https://www.dmzx-web.net & martin - https://www.martins-phpbb.com
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
	'FILEUPLOAD_UPLOAD'						=> 'Subida de Archivos',
	'FILEUPLOAD_UPLOAD_SECTION'				=> 'Sección de Subida de Archivos',
	'FILEUPLOAD_UPLOAD_MESSAGE'				=> 'Suba su archivo aquí. (Tenga en cuenta que esta carpeta se vacía, y todas las subidas se registran).',
	'FILEUPLOAD_NOT_ENABELD'				=> 'Subida de Archivos no está habilitado',
	'FILEUPLOAD_NEW_DOWNLOAD_SIZE'			=> '¡El tamaño máximo del archivo es <strong>%1$s %2$s</strong>! ¡Debido al tiempo de carga que puede necesitar, este valor puede ser menor!',
	'FILEUPLOAD_NO_FILENAME'				=> '¡Tiene que ingresar un archivo, para su subida!',
	'FILEUPLOAD_FILE_TOO_BIG'				=> '¡El archivo es más grande, de lo que su hosting permite!',
	'FILEUPLOAD_NEW_ADDED'					=> 'Tu entrada se añadió correctamente a la base de datos.',
	'FILEUPLOAD_CURRENT_VERSION'			=> 'Versión',
	'FILEUPLOAD_NEW_FILENAME'				=> 'Nombre del archivo',
	'FILEUPLOAD_SUCCEEDED'					=> '¡Subida correcta!',
	'FILEUPLOAD_DIRECT_LINK'				=> 'Enlace directo',
	'FILEUPLOAD_URL_LINK'					=> 'URL',
	'FILEUPLOAD_FILE_LINK'					=> 'ARCHIVO',
	'FILEUPLOAD_BY'							=> 'Archivo subido por',
));
