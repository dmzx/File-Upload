<?php
/**
*
* @package phpBB Extension - File Upload
* @copyright (c) 2017 dmzx - https://www.dmzx-web.net & martin - https://www.martins-phpbb.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\fileupload\core;

use phpbb\template\template;
use phpbb\config\config;
use phpbb\extension\manager;

class functions
{
	/** @var template */
	protected $template;

	/** @var config */
	protected $config;

	/** @var manager */
	protected $extension_manager;

	/**
	* Constructor
	*
	* @param template		 	$template
	* @param config				$config
	* @param manager 			$extension_manager
	*
	*/
	public function __construct(
		template $template,
		config $config,
		manager $extension_manager
	)
	{
		$this->template 			= $template;
		$this->config 				= $config;
		$this->extension_manager	= $extension_manager;
	}

	/**
	* Assign authors
	*/
	public function assign_authors()
	{
		$md_manager = $this->extension_manager->create_extension_metadata_manager('dmzx/fileupload', $this->template);
		$meta = $md_manager->get_metadata();
		$author_names = array();
		$author_homepages = array();

		foreach (array_slice($meta['authors'], 0, 2) as $author)
		{
			$author_names[] = $author['name'];
			$author_homepages[] = sprintf('<a href="%1$s" title="%2$s">%2$s</a>', $author['homepage'], $author['name']);
		}
		$this->template->assign_vars(array(
			'FILEUPLOAD_DISPLAY_NAME'		=> $meta['extra']['display-name'],
			'FILEUPLOAD_AUTHOR_NAMES'		=> implode(' &amp; ', $author_names),
			'FILEUPLOAD_AUTHOR_HOMEPAGES'	=> implode(' &amp; ', $author_homepages),
			'FILEUPLOAD_VERSION'			=> $this->config['fileupload_system_version'],
		));

		return;
	}
}
