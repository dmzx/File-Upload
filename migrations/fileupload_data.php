<?php
/**
*
* @package phpBB Extension - File Upload
* @copyright (c) 2017 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\fileupload\migrations;

class fileupload_data extends \phpbb\db\migration\migration
{
	public function update_data()
	{
		return array(
			// Update configs
			array('config.add', array('fileupload_system_version', '1.0.0')),
			array('config.add', array('fileupload_enable', 1)),
			array('config.add', array('fileupload_number', 2)),
			// Add permission
			array('permission.add', array('u_file_upload', true)),
			// Set permission
			array('permission.permission_set', array('ADMINISTRATORS', 'u_file_upload', 'group')),

			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_FILE_UPLOAD'
			)),
			array('module.add', array(
				'acp',
				'ACP_FILE_UPLOAD',
				array(
					'module_basename'	=> '\dmzx\fileupload\acp\fileupload_module',
					'modes'	=> array(
						'configuration'
					),
				),
			)),
		);
	}
}
