<?php
/**
*
* BoardRules [Russian]
*
* @package language Board Rules
* @copyright (c) 2014 HAMMER663
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}
$lang = array_merge($lang, array(
	'BOARD_RULES'			=> 'Правила',
	'BOARD_RULES_CATS'		=> 'Содержание',
	'BOARD_RULES_HDR'		=> 'Правила конференции',
));