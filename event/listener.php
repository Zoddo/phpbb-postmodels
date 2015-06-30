<?php
/**
 *
 * @package Post Models Extension
 * @copyright (c) 2015 Zoddo <zoddo.ino@gmail.com>
 * @copyright (c) 2007 Elglobo <http://www.phpbb-services.com>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace zoddo\postmodels\event;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			// ACP
			'core.permissions'						=> 'add_permission',
		);
	}

	/**
	 * Add permissions
	 *
	 * @param object	$event			The event object
	 */
	public function add_permission($event)
	{
		$permissions = $event['permissions'];
		$permissions += array(
			// ACP
			'a_models'		=> array('lang' => 'ACL_A_MODELS', 'cat' => 'posting'),

			// Forum
			'f_models'		=> array('lang' => 'ACL_F_MODELS', 'cat' => 'post'),

			// UCP
			'u_pm_models'	=> array('lang' => 'ACL_U_PM_MODELS', 'cat' => 'pm'),
		);
		$event['permissions'] = $permissions;
	}
}