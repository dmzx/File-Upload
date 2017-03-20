<?php
/**
*
* @package phpBB Extension - File Upload
* @copyright (c) 2017 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\fileupload\migrations;

class fileupload_install extends \phpbb\db\migration\migration
{
	public function update_data()
	{
		return array(
			// Add configs
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
				'ACP_FILE_UPLOAD',
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

	public function update_schema()
	{
		return array(
			'add_tables'	=> array(
				$this->table_prefix . 'file_upload'	=> array(
					'COLUMNS'	=> array(
						'fileupload_id'			=> array('UINT:8', null, 'auto_increment'),
						'fileupload_filename'	=> array('VCHAR', ''),
						'fileupload_realname'	=> array('VCHAR', ''),
						'upload_time'			=> array('UINT:8', 0),
						'filesize'				=> array('INT:11', 0),
						'user_id'				=> array('INT:8', 0),
					),
					'PRIMARY_KEY'	=> 'fileupload_id',
				),
			),
		);
	}

	public function revert_schema()
	{
		return 	array(
			'drop_tables' => array(
				$this->table_prefix . 'file_upload',
			),
		);
	}
}
