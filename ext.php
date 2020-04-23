<?php
/**
 *
 * @package Post Models Extension
 * @copyright (c) 2015 Zoddo <zoddo.ino@gmail.com>
 * @copyright (c) 2007 Elglobo <http://www.phpbb-services.com>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace zoddo\postmodels;

/**
 * Extension class for custom enable/disable/purge actions
 *
 * NOTE TO EXTENSION DEVELOPERS:
 * Normally it is not necessary to define any functions inside the ext class below.
 * The ext class may contain special (un)installation commands in the methods
 * enable_step(), disable_step() and purge_step(). As it is, these methods are defined
 * in phpbb_extension_base, which this class extends, but you can overwrite them to
 * give special instructions for those cases.
 */
class ext extends \phpbb\extension\base
{
	/**
	 * Check whether or not the extension can be enabled.
	 * The current phpBB version should meet or exceed
	 * the minimum version required by this extension:
	 *
	 * Requires phpBB 3.2.1 and PHP 5.4.
	 *
	 * @return bool
	 * @access public
	 */
	public function is_enableable()
	{
		$config = $this->container->get('config');

		return phpbb_version_compare($config['version'], '3.2.1', '>=') && version_compare(PHP_VERSION, '5.4', '>=');
	}
}
