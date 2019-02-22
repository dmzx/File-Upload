<?php
/**
*
* @package phpBB Extension - File Upload
* @copyright (c) 2017 dmzx - https://www.dmzx-web.net & martin - https://www.martins-phpbb.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\fileupload\controller;

use phpbb\config\config;
use phpbb\template\template;
use phpbb\log\log_interface;
use phpbb\user;
use phpbb\request\request_interface;
use phpbb\db\driver\driver_interface as db_interface;
use phpbb\pagination;
use phpbb\extension\manager;
use phpbb\path_helper;

class admin_controller
{
	/** @var config */
	protected $config;

	/** @var template */
	protected $template;

	/** @var log_interface */
	protected $log;

	/** @var user */
	protected $user;

	/** @var request_interface */
	protected $request;

	/** @var db_interface */
	protected $db;

	/** @var pagination */
	protected $pagination;

	/** @var manager */
	protected $ext_manager;

	/** @var path_helper */
	protected $path_helper;

	/**
	* The database table
	*
	* @var string
	*/
	protected $file_upload_table;

	/** @var string Custom form action */
	protected $u_action;

	/**
	 * Constructor
	 *
	 * @param config				$config
	 * @param template				$template
	 * @param log_interface			$log
	 * @param user					$user
	 * @param request_interface		$request
	 * @param db_interface			$db
	 * @param pagination			$pagination
	 * @param manager				$ext_manager
	 * @param path_helper			$path_helper
	 * @param string 				$file_upload_table
	 */
	public function __construct(
		config $config,
		template $template,
		log_interface $log,
		user $user,
		request_interface $request,
		db_interface $db,
		pagination $pagination,
		manager $ext_manager,
		path_helper $path_helper,
		$file_upload_table
	)
	{
		$this->config 				= $config;
		$this->template 			= $template;
		$this->log 					= $log;
		$this->user 				= $user;
		$this->request 				= $request;
		$this->db 					= $db;
		$this->pagination 			= $pagination;
		$this->ext_manager	 		= $ext_manager;
		$this->path_helper	 		= $path_helper;
		$this->file_upload_table 	= $file_upload_table;
		$this->ext_path 			= $this->ext_manager->get_extension_path('dmzx/fileupload', true);
		$this->ext_path_web 		= $this->path_helper->update_web_root_path($this->ext_path);

		$this->user->add_lang_ext('dmzx/fileupload', 'acp_fileupload');
	}

	/**
	* Display the options a user can configure for this extension
	*
	* @return null
	* @access public
	*/
	public function display_options()
	{
		$start		= $this->request->variable('start', 0);
		$sort_days	= $this->request->variable('st', 0);
		$sort_key	= $this->request->variable('sk', 'upload_time');
		$sort_dir	= $this->request->variable('sd', 'd');
		$ids 		= $this->request->variable('ids', array(0));
		$deletemark	= $this->request->variable('delmarked', false, false, \phpbb\request\request_interface::POST);
		$number		= $this->config['topics_per_page'];

		add_form_key('acp_fileupload');

		// Is the form being submitted to us?
		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key('acp_fileupload'))
			{
				trigger_error('FORM_INVALID');
			}

			// Set the options the user configured
			$this->set_options();

			// Add option settings change action to the admin log
			$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_FILEUPLOAD_SETTINGS');

			trigger_error($this->user->lang['ACP_FILEUPLOAD_SAVED'] . adm_back_link($this->u_action));
		}

		$max_filesize = @ini_get('upload_max_filesize');
		$unit = 'MB';

		if (!empty($max_filesize))
		{
			$unit = strtolower(substr($max_filesize, -1, 1));
			$max_filesize = (int) $max_filesize;
			$unit = ($unit == 'k') ? 'KB' : (($unit == 'g') ? 'GB' : 'MB');
		}

		// Total number of files
		$sql = 'SELECT COUNT(fileupload_id) AS total_fileupload, SUM(filesize) AS total_filesize
			FROM ' . $this->file_upload_table;
		$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($result);
		$total_fileupload = $row['total_fileupload'];
		$total_filesize = $row['total_filesize'];
		$this->db->sql_freeresult($result);

		$limit_days = array(
			0 => $this->user->lang['ALL_ENTRIES'],
			1 => $this->user->lang['1_DAY'],
			7 => $this->user->lang['7_DAYS'],
			14 => $this->user->lang['2_WEEKS'],
			30 => $this->user->lang['1_MONTH'],
			90 => $this->user->lang['3_MONTHS'],
			180 => $this->user->lang['6_MONTHS'],
			365 => $this->user->lang['1_YEAR']
		);
		$sort_by_text = array(
			'd' => $this->user->lang['ACP_FILEUPLOAD_SORT_DATE'],
			't' => $this->user->lang['ACP_FILEUPLOAD_TITLE'],
			'c' => $this->user->lang['ACP_FILEUPLOAD_SORT_USERNAME'],
			's' => $this->user->lang['ACP_FILEUPLOAD_SIZE']
		);
		$sort_by_sql = array(
			'd' => 'upload_time',
			't' => 'fileupload_filename',
			'c' => 'username',
			's' => 'filesize'
		);
		$s_limit_days = $s_sort_key = $s_sort_dir = $u_sort_param = '';
		gen_sort_selects($limit_days, $sort_by_text, $sort_days, $sort_key, $sort_dir, $s_limit_days, $s_sort_key, $s_sort_dir, $u_sort_param);
		$sql_sort_order = $sort_by_sql[$sort_key] . ' ' . (($sort_dir == 'd') ? 'DESC' : 'ASC');

		// List all files
		$sql = 'SELECT im.*, u.user_id, u.username, u.user_colour
			FROM ' . $this->file_upload_table . ' im, ' . USERS_TABLE . ' u
			WHERE u.user_id = im.user_id
			ORDER BY ' . $sql_sort_order;
		$result = $this->db->sql_query_limit($sql, $number, $start);

		while ($row = $this->db->sql_fetchrow($result))
		{
			$file_name = $row['fileupload_realname'];

			$filesize = @filesize($this->ext_path_web . 'files/' . $file_name);

			$this->template->assign_block_vars('files', array(
				'FILENAME'			=> $row['fileupload_filename'],
				'FILENAME_REAL'		=> $file_name,
				'SIZE'				=> get_formatted_filesize($filesize),
				'FILE_USERNAME'		=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
				'ID'				=> $row['fileupload_id'],
			));
		}
		$this->db->sql_freeresult($result);

		$base_url = $this->u_action;

		//Start pagination
		$this->pagination->generate_template_pagination($base_url, 'pagination', 'start', $total_fileupload, $number, $start);

		$this->template->assign_vars(array(
			'ACP_FILEUPLOAD_VERSION'			=> $this->config['fileupload_system_version'],
			'ACP_FILEUPLOAD_ENABLE'				=> $this->config['fileupload_enable'],
			'ACP_FILEUPLOAD_NUMBER'				=> $this->config['fileupload_number'],
			'ACP_FILEUPLOAD_ALLOWED_SIZE'		=> sprintf($this->user->lang['ACP_FILEUPLOAD_NEW_DOWNLOAD_SIZE'], $max_filesize, $unit),
			'ACP_TOTAL_FILES'					=> $this->user->lang('ACP_MULTI_FILES', (int) $total_fileupload),
			'TOTAL_FILE_SIZE'					=> get_formatted_filesize($total_filesize),
			'S_SELECT_SORT_DIR'					=> $s_sort_dir,
			'S_SELECT_SORT_KEY'					=> $s_sort_key,
			'U_ACTION'							=> $this->u_action,
		));

		if (($deletemark))
		{
			if (!sizeof($ids))
			{
				trigger_error($this->user->lang('ACP_FILEUPLOAD_NOT_SELECTED') . adm_back_link($this->u_action));
			}

			if (confirm_box(true))
			{
				if (sizeof($ids))
				{
					foreach ($ids as $id)
					{
						$sql = 'SELECT fileupload_realname, fileupload_filename
							FROM ' . $this->file_upload_table . '
							WHERE fileupload_id = ' . (int) $id;
						$result = $this->db->sql_query($sql);
						$row = $this->db->sql_fetchrow($result);
						$file_name = $row['fileupload_realname'];
						$this->db->sql_freeresult($result);

						$delete_file = $this->ext_path_web . 'files/' . $file_name;

						@unlink($delete_file);

						$sql = 'DELETE FROM ' . $this->file_upload_table . '
							WHERE fileupload_id = ' . (int) $id;
						$this->db->sql_query($sql);

						// Log message
						$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_FILEUPLOAD_DELETED', time(), array($file_name));
					}
				}
			}
			else
			{
				confirm_box(false, $this->user->lang['ACP_FILEUPLOAD_REALLY_DELETE_FILE'], build_hidden_fields(array(
					'ids'		=> $ids,
					'delmarked'	=> $deletemark,
					'action'	=> $this->u_action))
				);
			}
			redirect($this->u_action);
		}
	}
	/**
	* Set the options a user can configure
	*
	* @return null
	* @access protected
	*/
	protected function set_options()
	{
		$this->config->set('fileupload_enable', $this->request->variable('fileupload_enable', 1));
		$this->config->set('fileupload_number', $this->request->variable('fileupload_number', 2));
	}

	/**
	* Set page url
	*
	* @param string $u_action Custom form action
	* @return null
	* @access public
	*/
	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;
	}
}
