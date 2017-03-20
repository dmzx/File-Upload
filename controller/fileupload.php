<?php
/**
*
* @package phpBB Extension - File Upload
* @copyright (c) 2017 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\fileupload\controller;

use phpbb\exception\http_exception;
use phpbb\config\config;
use dmzx\fileupload\core\functions;
use phpbb\template\template;
use phpbb\user;
use phpbb\auth\auth;
use phpbb\log\log_interface;
use phpbb\db\driver\driver_interface as db_interface;
use phpbb\controller\helper;
use phpbb\request\request_interface;
use phpbb\extension\manager;
use phpbb\path_helper;
use phpbb\files\factory;

class fileupload
{
	/** @var config */
	protected $config;

	/** @var functions */
	protected $functions;

	/** @var template */
	protected $template;

	/** @var user */
	protected $user;

	/** @var auth */
	protected $auth;

	/** @var log_interface */
	protected $log;

	/** @var db_interface */
	protected $db;

	/** @var helper */
	protected $helper;

	/** @var request_interface */
	protected $request;

	/** @var manager */
	protected $ext_manager;

	/** @var path_helper */
	protected $path_helper;

	/** @var string */
	protected $php_ext;

	/** @var string */
	protected $root_path;

	/**
	* The database table
	*
	* @var string
	*/
	protected $file_upload_table;

	/** @var factory */
	protected $files_factory;

	protected $allowed_extensions = array(
		'zip',
		'rar',
	);

	/**
	* Constructor
	*
	* @param config							$config
	* @param functions						$functions
	* @param template		 				$template
	* @param user							$user
	* @param auth							$auth
	* @param log_interface					$log
	* @param db_interface					$db
	* @param helper		 					$helper
	* @param request_interface				$request
	* @param manager						$ext_manager
	* @param path_helper					$path_helper
	* @param string 						$php_ext
	* @param string 						$root_path
	* @param string 						$file_upload_table
	* @param factory						$files_factory
	*
	*/
	public function __construct(
		config $config,
		functions $functions,
		template $template,
		user $user,
		auth $auth,
		log_interface $log,
		db_interface $db,
		helper $helper,
		request_interface $request,
		manager $ext_manager,
		path_helper $path_helper,
		$php_ext,
		$root_path,
		$file_upload_table,
		factory $files_factory = null
	)
	{
		$this->config 				= $config;
		$this->functions 			= $functions;
		$this->template 			= $template;
		$this->user 				= $user;
		$this->auth 				= $auth;
		$this->log 					= $log;
		$this->db 					= $db;
		$this->helper 				= $helper;
		$this->request 				= $request;
		$this->ext_manager	 		= $ext_manager;
		$this->path_helper	 		= $path_helper;
		$this->php_ext 				= $php_ext;
		$this->root_path 			= $root_path;
		$this->file_upload_table 	= $file_upload_table;
		$this->files_factory 		= $files_factory;
		$this->ext_path 			= $this->ext_manager->get_extension_path('dmzx/fileupload', true);
		$this->ext_path_web 		= $this->path_helper->update_web_root_path($this->ext_path);
	}

	public function handle_fileupload()
	{
		if (!$this->auth->acl_get('u_file_upload'))
		{
			if (!$this->user->data['is_registered'])
			{
				login_box();
			}
			throw new http_exception(403, 'NOT_AUTHORISED');
		}

		if (!$this->config['fileupload_enable'])
		{
			if (!$this->user->data['is_registered'])
			{
				login_box();
			}
			throw new http_exception(403, 'FILEUPLOAD_NOT_ENABELD');
		}

		$title			= $this->request->variable('title', '', true);
		$filename		= $this->request->variable('filename', '', true);
		$max_filesize 	= $this->config['fileupload_number'];
		$unit = 'MB';

		if (!empty($max_filesize))
		{
			$unit = strtolower(substr($max_filesize, -1, 1));
			$max_filesize = (int) $max_filesize;
			$unit = ($unit == 'k') ? 'KB' : (($unit == 'g') ? 'GB' : 'MB');
		}

		add_form_key('add_fileupload');

		$this->user->add_lang('posting');

		// Add allowed extensions
		$allowed_extensions = $this->allowed_extensions;

		if ($this->request->is_set_post('submit'))
		{
			$filecheck = $multiplier = '';

			if ($this->files_factory !== null)
			{
				$fileupload = $this->files_factory->get('upload')
					->set_allowed_extensions($allowed_extensions);
			}
			else
			{
				if (!class_exists('\fileupload'))
				{
					include($this->root_path . 'includes/functions_upload.' . $this->php_ext);
				}
				$fileupload = new \fileupload();
				$fileupload->fileupload('', $allowed_extensions);
			}

			$upload_dir = 'ext/dmzx/fileupload/files/';

			$upload_file = (isset($this->files_factory)) ? $fileupload->handle_upload('files.types.form', 'filename') : $fileupload->form_upload('filename');

			if (!$upload_file->get('uploadname'))
			{
				meta_refresh(3, $this->helper->route('dmzx_fileupload_controller_upload'));
				throw new http_exception(400, 'FILEUPLOAD_NO_FILENAME');
			}

			$upload_file->clean_filename('uploadname');
			$upload_file->move_file(str_replace($this->root_path, '', $upload_dir), true, true, 0644);
			@chmod($this->ext_path_web . 'files/' . $upload_file->get('uploadname'), 0644);

			if (sizeof($upload_file->error) && $upload_file->get('uploadname'))
			{
				$upload_file->remove();
				meta_refresh(3, $this->helper->route('dmzx_fileupload_controller_upload'));

				trigger_error(implode('<br />', $upload_file->error));
			}

			// End the upload
			$sql_ary = array(
				'fileupload_filename'	=> ucfirst(str_replace('_', ' ', preg_replace('#^(.*)\..*$#', '\1', $upload_file->get('uploadname')))),
				'fileupload_realname'	=> $upload_file->get('realname'),
				'upload_time'			=> time(),
				'filesize'				=> $upload_file->get('filesize'),
				'user_id'				=> $this->user->data['user_id'],
			);

			if ($unit == 'MB')
			{
				$multiplier = 1048576;
			}
			else if ($unit == 'KB')
			{
				$multiplier = 1024;
			}

			if ($upload_file->get('filesize') > ($max_filesize * $multiplier))
			{
				@unlink($this->root_path . $upload_dir . '/' . $upload_file->get('realname'));
				meta_refresh(3, $this->helper->route('dmzx_fileupload_controller_upload'));

				throw new http_exception(400, 'FILEUPLOAD_FILE_TOO_BIG');
			}

			$filesize = @filesize($this->root_path . $upload_dir . '/' . $upload_file->get('realname'));

			$this->template->assign_vars(array(
				'FILENAME'	=> generate_board_url() . '/' . $upload_dir . $upload_file->get('realname'),
				'SIZE'		=> get_formatted_filesize($filesize),
			));

			$this->db->sql_query('INSERT INTO ' . $this->file_upload_table .' ' . $this->db->sql_build_array('INSERT', $sql_ary));
			// Log message
			$this->log_message('LOG_FILEUPLOAD_ADD', $upload_file->get('uploadname'), 'FILEUPLOAD_NEW_ADDED');
		}

		$ext_count = 0;
		$first_extension = true;

		foreach ($allowed_extensions as $ext)
		{
			$ext_count++;
			$this->template->assign_block_vars('allowed_extension', array(
				'EXTENSION' => strtolower(trim($ext)),
				'FIRST'		=> $first_extension,
			));
			$first_extension = false;
		}

		$form_enctype = (@ini_get('file_uploads') == '0' || strtolower(@ini_get('file_uploads')) == 'off') ? '' : ' enctype="multipart/form-data"';

		$this->template->assign_vars(array(
			'FILEUPLOAD_ALLOWED_SIZE'		=> sprintf($this->user->lang['FILEUPLOAD_NEW_DOWNLOAD_SIZE'], $max_filesize, $unit),
			'S_FORM_ENCTYPE'				=> $form_enctype,
		));

		// Build navigation link
		$this->template->assign_block_vars('navlinks', array(
			'FORUM_NAME'	=> $this->user->lang('FILEUPLOAD_UPLOAD_SECTION'),
			'U_VIEW_FORUM'	=> $this->helper->route('dmzx_fileupload_controller_upload'),
		));

		$this->functions->assign_authors();
		$this->template->assign_var('FILEUPLOAD_FOOTER_VIEW', true);

		// Send all data to the template file
		return $this->helper->render('fileupload_body.html', $this->user->lang('FILEUPLOAD_UPLOAD_SECTION'));
	}

	/**
	 * Log Message
	 *
	 * @return message
	 * @access private
	*/
	private function log_message($log_message, $title, $user_message)
	{
		$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, $log_message, time(), array($title));
	}
}
