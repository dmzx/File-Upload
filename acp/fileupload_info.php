<?php
/**
*
* @package phpBB Extension - File Upload
* @copyright (c) 2017 dmzx - https://www.dmzx-web.net & martin - https://www.martins-phpbb.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\fileupload\acp;

class fileupload_info
{
	function module()
	{
		return array(
			'filename'	=> '\dmzx\fileupload\acp\fileupload_module',
			'title'		=> 'ACP_FILE_UPLOAD',
			'modes'		=> array(
				'configuration'	=> array(
					'title' => 'ACP_FILE_UPLOAD_CONFIG',
					'auth' 	=> 'ext_dmzx/fileupload && acl_a_board',
					'cat' 	=> array('ACP_FILE_UPLOAD')
				),
			),
		);
	}
}
