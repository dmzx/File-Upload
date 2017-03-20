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
	' FILEUPLOAD_UPLOAD '						 =>	' Téléchargement de fichiers ',
	' FILEUPLOAD_UPLOAD_SECTION '				 =>	' Fichier section de chargement ',
	' FILEUPLOAD_UPLOAD_MESSAGE '				 =>	' Téléchargez votre fichier ici. (Notez que ce dossier va se vider et tous les téléchargements sont connectés) ',
	' FILEUPLOAD_NOT_ENABELD '					 =>	' Téléchargement de fichiers est pas activé ',
	' FILEUPLOAD_NEW_DOWNLOAD_SIZE '			 =>	' La taille maximale du fichier est <strong>%1$s %2$s</strong>! En raison du temps de téléchargement vous pourriez avoir besoin, cette valeur peut être plus faible! ',
	' FILEUPLOAD_NO_FILENAME '					 =>	' Vous devez entrer un fichier, qui appartient à votre téléchargement! ',
	' FILEUPLOAD_FILE_TOO_BIG '					 =>	' Le fichier est plus grand, que votre hôte permet! ',
	' FILEUPLOAD_NEW_ADDED '					 =>	' Votre entrée a été ajouté avec succès à la base de données ',
	' FILEUPLOAD_CURRENT_VERSION '				 =>	' Version ',
	' FILEUPLOAD_NEW_FILENAME '					 =>	' Nom du fichier ',
	' FILEUPLOAD_SUCCEEDED '					 =>	' Télécharger Réussi! ',
	' FILEUPLOAD_DIRECT_LINK '					 =>	' Lien direct ',
	' FILEUPLOAD_URL_LINK '						 =>	' URL ',
	' FILEUPLOAD_FILE_LINK '					 =>	' FICHIER ',
	' FILEUPLOAD_BY '							 =>	' Télécharger fichier par ',
));
