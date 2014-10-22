<?php
/**
*
* @package Board Rules
* @copyright (c) 2014 HAMMER663
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace hammer663\BoardRules\controller;

use Symfony\Component\HttpFoundation\Response;

	
class rules
{
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\template\template $template, \phpbb\user $user, $phpbb_root_path, $php_ext)
	{
		$this->config = $config;
		$this->db = $db;
		$this->auth = $auth;
		$this->template = $template;	
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	public function main()
	{

		// Load the appropriate faq file		
		$this->user->add_lang_ext('hammer663/BoardRules', 'board_rules');
		
		$page_title = $this->user->lang['BOARD_RULES'];
		$template_html = 'rules_body.html';

		$cat_count = 0;
		$rule_count = 0;
		$subrule_count = 0;
		$subsubrule_count = 0;

		// Pull the array data from the lang pack
		$help_blocks = array();
		foreach ($this->user->help as $help_ary)
		{
			if ($help_ary[0] == '--') // It's category
			{
				$cat_count++;
				$rule_count = 0;

				$this->template->assign_block_vars('cat_row', array(
					'CAT_TEXT'			=> $help_ary[1],
					'CAT_NUMBER'		=> $cat_count,
				));

				continue;
			}

			elseif (strpos($help_ary[0], '~~') === 0) // It's subsubrule
			{
				$subsubrule_count++;

				$this->template->assign_block_vars('cat_row.rule_row.subrule_row.subsubrule_row', array(
					'SUBSUBRULE_TEXT'		=> $help_ary[1],
					'SUBSUBRULE_NUMBER'		=> $cat_count . '.' . $rule_count . '.' . $subrule_count . '.' . $subsubrule_count,
				));

				continue;
			}

			elseif (strpos($help_ary[0], '~') === 0) // It's subrule
			{
				$subrule_count++;
				$subsubrule_count = 0;

				$this->template->assign_block_vars('cat_row.rule_row.subrule_row', array(
					'SUBRULE_TEXT'			=> $help_ary[1],
					'SUBRULE_NUMBER'		=> $cat_count . '.' . $rule_count . '.' . $subrule_count,
				));
				
				continue;
			}

			else // Hyphen & tilde not found? So it's rule
			{
				$rule_count++;
				$subrule_count = 0;

				$this->template->assign_block_vars('cat_row.rule_row', array(
					'RULE_TEXT'			=> $help_ary[1],
					'RULE_NUMBER'		=> $cat_count . '.' . $rule_count,
				));
				
				continue;
			}
		}

		// If we have more than 6 categories, let's split the list of categories into two columns of equal height
		$this->template->assign_vars(array(
			'CAT_COUNT_HALF'		=> ($cat_count > 6) ? round($cat_count / 2 + 1) : 0,
		));

		// Output the page
		$this->template->assign_vars(array(
			'U_RULES'			=> append_sid("{$this->phpbb_root_path}rules"),			
		));

		page_header($page_title);

		$this->template->set_filenames(array(
			'body' => $template_html));

		make_jumpbox(append_sid("{$this->phpbb_root_path}viewforum.$this->php_ext"));
		page_footer();
		return new Response($this->template->return_display('body'), 200);

	}
}
