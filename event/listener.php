<?php
/**
*
* @package Board Rules
* @copyright (c) 2014 HAMMER663
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace hammer663\BoardRules\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;
	protected $controller_helper;
	/** @var string */
	protected $phpbb_root_path;
	protected $php_ext;
	protected $phpbb_dispatcher;
	/**
	* Constructor
	*/

	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\user $user, \phpbb\db\driver\driver_interface $db, \phpbb\template\template $template, \phpbb\controller\helper $controller_helper, $phpbb_root_path, $php_ext, \phpbb\event\dispatcher_interface $phpbb_dispatcher)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->user = $user;
		$this->db = $db;
		$this->template = $template;
		$this->controller_helper = $controller_helper;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
		$this->phpbb_dispatcher = $phpbb_dispatcher;		
	}

	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	* @static
	* @access public
	*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'	=> 'load_language_on_setup',		
			'core.page_header'	=>	'board_rules',
		);
	}
	
	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'hammer663/BoardRules',
			'lang_set' => 'board_rules',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}
	
	/**
	* Board Rules
	*
	* @return null
	* @access public
	*/
	public function board_rules($event)
	{

	//	$this->user->add_lang_ext('hammer663/BoardRules', 'board_rules');
//		$this->template->assign_vars(array(
//			'U_RULES'				=> append_sid("{$this->phpbb_root_path}rules/"),

//			'U_BOARDRULES' => $this->controller_helper->route('hammer663_BoardRules_rules'),
//		));



	}
//////////////
}
