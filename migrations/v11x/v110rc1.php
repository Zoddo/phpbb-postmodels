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

class v110rc1 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array(
			'\phpbb\db\migration\data\v31x\v314',
			'\zoddo\postmodels\migrations\v11x\v110beta1',
		);
	}

	public function update_data()
	{
		return array(
			array('config.update', array('post_models_version', '1.1.0-rc1')),
		);
	}
}
