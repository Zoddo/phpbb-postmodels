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
class v104 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array(
			'\zoddo\postmodels\migrations\v10x\v103',
		);
	}

	public function effectively_installed()
	{
		return isset($this->config['post_models_version']) && phpbb_version_compare($this->config['post_models_version'], '1.0.4', '>=');
	}

	public function update_data()
	{
		return array(
			array('config.update', array('post_models_version', '1.0.4')),
		);
	}
}
