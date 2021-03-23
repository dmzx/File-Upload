<?php
/**
*
* @package phpBB Extension - File Upload
* @copyright (c) 2021 dmzx - https://www.dmzx-web.net & martin - https://www.martins-phpbb-test.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\fileupload\migrations;

class fileupload_v105 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return [
			'\dmzx\fileupload\migrations\fileupload_v104',
		];
	}

	public function update_data()
	{
		return [
			['config.update', ['fileupload_system_version', '1.0.5']],
		];
	}
}
