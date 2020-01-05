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
use zoddo\postmodels\helper\helper;

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

			// Posting
			'core.posting_modify_template_vars'		=> 'add_posting_vars',
			'core.ucp_pm_compose_modify_data'		=> 'add_pm_vars',
		);
	}

	/** @var \zoddo\postmodels\helper\helper */
	protected $helper;

	/**
	 * Constructor
	 *
	 * @param \zoddo\postmodels\helper\helper		$helper			Helper object
	 */
	public function __construct(helper $helper)
	{
		$this->helper = $helper;
	}

	/**
	 * Adds permissions
	 *
	 * @param object	$event			The event object
	 */
	public function add_permission($event)
	{
		$event->update_subarray('permissions', 'a_models', ['lang' => 'ACL_A_MODELS', 'cat' => 'posting']);
		$event->update_subarray('permissions', 'f_models', ['lang' => 'ACL_F_MODELS', 'cat' => 'post']);
		$event->update_subarray('permissions', 'u_pm_models', ['lang' => 'ACL_U_PM_MODELS', 'cat' => 'pm']);
	}

	/**
	 * Assigns template vars for posting
	 *
	 * @param object	$event			The event object
	 */
	public function add_posting_vars($event)
	{
		$this->helper->generate_post_models($event['forum_id']);
	}

	/**
	 * Assigns template vars for PMs
	 */
	public function add_pm_vars()
	{
		$this->helper->generate_post_models();
	}
}
