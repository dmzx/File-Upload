<?php
/**
*
* @package phpBB Extension - File Upload
* @copyright (c) 2017 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* DO NOT CHANGE
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
	'ACP_FILEUPLOAD_SAVED'					=> 'File Upload settings saved',
	'ACP_FILEUPLOAD_VERSION'				=> 'Version',
	'ACP_FILE_UPLOAD_CONFIGURATION'			=> 'File Upload Configuration',
	'ACP_FILEUPLOAD_ENABLE'					=> 'Enable File Upload',
	'ACP_FILEUPLOAD_ENABLE_EXPLAIN'			=> 'Global setting to enable File Upload.',
	'ACP_FILEUPLOAD_NUMBER'					=> 'Size of upload',
	'ACP_FILEUPLOAD_NUMBER_EXPLAIN'			=> 'Set size of upload in MB default is 2 MB.',
	'ACP_FILEUPLOAD_NEW_DOWNLOAD_SIZE'		=> 'The maximum size your php.ini allows is <strong>%1$s %2$s</strong>!',
	'ACP_FILEUPLOAD_REALLY_DELETE_FILE'		=> 'Really delete file?',
	'ACP_FILEUPLOAD_TITLE'					=> 'File name',
	'ACP_FILEUPLOAD_TITLE_REAL'				=> 'File real name',
	'ACP_FILEUPLOAD_PREVIEW'				=> 'Preview',
	'ACP_FILEUPLOAD_WIDTH_HEIGHT'			=> 'Width/Height',
	'ACP_FILEUPLOAD_FOLDER_SIZE'			=> 'Total folder size',
	'ACP_FILEUPLOAD_USERNAME'				=> 'Uploaded by',
	'ACP_FILEUPLOAD_SIZE'					=> 'Size',
	'ACP_MULTI_FILES'		=>	array(
		1 => '%s file',
		2 => '%s files',
	),
	'ACP_FILEUPLOAD_SORT_USERNAME'			=> 'Username',
	'ACP_FILEUPLOAD_SORT_DATE'				=> 'Date',
	'ACP_FILEUPLOAD_NOT_SELECTED'			=> 'Not selected any files',
));
