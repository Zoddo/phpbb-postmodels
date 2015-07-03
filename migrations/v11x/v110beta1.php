<?php
/**
 *
 * @package Post Models Extension
 * @copyright (c) 2015 Zoddo <zoddo.ino@gmail.com>
 * @copyright (c) 2007 Elglobo <http://www.phpbb-services.com>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace zoddo\postmodels\migrations\v11x;

class v110beta1 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array(
			'\phpbb\db\migration\data\v310\gold',
			'\zoddo\postmodels\migrations\v10x\v104a',
		);
	}

	public function update_data()
	{
		return array(
			array('config.update', array('post_models_version', '1.1.0-b1')),
			array('config.remove', array('post_models_enable')), // We remove this option since than an extension can be easily disabled

			// We remove the old acp module
			array('if', array(
				array('module.exists', array('acp', 'ACP_GENERAL_TASKS', 'ACP_MANAGE_MODELS')),
				array('module.remove', array('acp', 'ACP_GENERAL_TASKS', 'ACP_MANAGE_MODELS')),
			)),

			array('module.add', array('acp', 'ACP_MESSAGES', array(
				'module_basename'		=> '\zoddo\postmodels\acp\models_module',
				'modes'					=> array('main'),
			))),
		);
	}
}
