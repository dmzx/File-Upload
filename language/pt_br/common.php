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
	'FILEUPLOAD_UPLOAD'				=> 'Upload de Arquivo',
	'FILEUPLOAD_UPLOAD_SECTION'		=> 'Seção Upload de Arquivo',
	'FILEUPLOAD_UPLOAD_MESSAGE'		=> 'Faça upload de seu arquivo aqui. (Observe que esta pasta será esvaziada e todos os uploads serão registrados)',
	'FILEUPLOAD_NOT_ENABELD'		=> 'Upload de Arquivo não está habilitado',
	'FILEUPLOAD_NEW_DOWNLOAD_SIZE'	=> 'O tamanho máximo do arquivo é	<strong>%1$s %2$s</strong>! Devido ao tempo necessário para o upload, este valor pode ser ainda menor!',
	'FILEUPLOAD_NO_FILENAME'		=> 'Você tem que entrar um arquivo que pertença aos seus uploads!',
	'FILEUPLOAD_FILE_TOO_BIG'		=> 'O arquivo é maior que o permitido pelo host!',
	'FILEUPLOAD_NEW_ADDED'			=> 'Sua entrada foi adicionada ao banco de dados com sucesso',
	'FILEUPLOAD_CURRENT_VERSION'	=> 'Versão',
	'FILEUPLOAD_NEW_FILENAME'		=> 'Nome do arquivo',
	'FILEUPLOAD_SUCCEEDED'			=> 'Upload com sucesso!',
	'FILEUPLOAD_DIRECT_LINK'		=> 'Link direto',
	'FILEUPLOAD_URL_LINK'			=> 'URL',
	'FILEUPLOAD_FILE_LINK'			=> 'Arquivo',
	'FILEUPLOAD_BY'					=> 'Upload por',
));
