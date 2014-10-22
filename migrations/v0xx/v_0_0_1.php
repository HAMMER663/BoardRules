<?php
/**
*
* @package Board Rules
* @copyright (c) 2014 HAMMER663
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

namespace hammer663\BoardRules\migrations\v0xx;

class v_0_0_1 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['br_version']) && version_compare($this->config['br_version'], '0.0.1', '>=');
	}

	static public function depends_on()
	{
			return array('\phpbb\db\migration\data\v310\dev');
	}

	public function update_data()
	{
		return array(
			
			// Current version
			array('config.add', array('br_version', '0.0.1')),
		);
	}
}
