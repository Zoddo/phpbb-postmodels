<?php
/**
 *
 * @package Post Models Extension
 * @copyright (c) 2015 Zoddo <zoddo.ino@gmail.com>
 * @copyright (c) 2007 Elglobo <http://www.phpbb-services.com>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace zoddo\postmodels\migrations\v10x;

/**
 * Changes made by the 3.0.x MOD written by Elglobo
 */
class v102 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array(
			'\phpbb\db\migration\data\v310\alpha1',
		);
	}

	public function effectively_installed()
	{
		return isset($this->config['post_models_version']) && phpbb_version_compare($this->config['post_models_version'], '1.0.2', '>=');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('post_models_version', '1.0.2')),
			array('config.add', array('post_models_enable', true)),

			array('permission.add', array('a_models')),
			array('permission.permission_set', array('ROLE_ADMIN_FULL', 'a_models')),
			array('permission.permission_set', array('ROLE_ADMIN_STANDARD', 'a_models')),

			array('permission.add', array('f_models', false)),
			array('permission.permission_set', array('ROLE_FORUM_FULL', 'f_models')),
			array('permission.permission_set', array('ROLE_FORUM_POLLS', 'f_models')),
			array('permission.permission_set', array('ROLE_FORUM_STANDARD', 'f_models')),

			array('permission.add', array('u_pm_models')),
			array('permission.permission_set', array('ROLE_USER_FULL', 'u_pm_models')),
			array('permission.permission_set', array('ROLE_USER_STANDARD', 'u_pm_models')),
		);
	}

	public function update_schema()
	{
		return array(
			'add_tables'		=> array(
				$this->table_prefix . 'models'			=> array(
					'COLUMNS'		=> array(
						'model_id'			=> array('UINT', null, 'auto_increment'),
						'model_title'		=> array('VCHAR', ''),
						'model_content'		=> array('MTEXT', ''),
						'model_auth'		=> array('TINT:1', 0),
						'model_pm'			=> array('TINT:1', 0),
						'model_lang'		=> array('VCHAR:30', ''),
					),
					'PRIMARY_KEY'	=> 'model_id',
					'KEYS'			=> array(
						'model_lang'		=> array('INDEX', 'model_lang'),
					),
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_tables'		=> array(
				$this->table_prefix . 'models',
			),
		);
	}
}
