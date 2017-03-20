<?php
/**
*
* @package phpBB Extension - File Upload
* @copyright (c) 2017 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\fileupload\migrations;

class fileupload_v101 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array(
			'\dmzx\fileupload\migrations\fileupload_install',
		);
	}

	public function update_data()
	{
		return array(
			array('config.update', array('fileupload_system_version', '1.0.1')),
		);
	}
}
