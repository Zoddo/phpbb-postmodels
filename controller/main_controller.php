<?php
/**
 *
 * @package Post Models Extension
 * @copyright (c) 2015 Zoddo <zoddo.ino@gmail.com>
 * @copyright (c) 2007 Elglobo <http://www.phpbb-services.com>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace zoddo\postmodels\controller;

use Symfony\Component\HttpFoundation\Response;

class main_controller
{
	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \zoddo\postmodels\event\listener */
	protected $postmodels_listener;

	/**
	 * Constructor
	 *
	 * @param \phpbb\controller\helper				$helper
	 * @param \phpbb\request\request				$request
	 * @param \zoddo\postmodels\event\listener		$postmodels_listener
	 */
	public function __construct(\phpbb\controller\helper $helper, \phpbb\request\request $request, \zoddo\postmodels\event\listener $postmodels_listener)
	{
		$this->helper = $helper;
		$this->request = $request;
		$this->postmodels_listener = $postmodels_listener;
	}

	public function refresh()
	{
		$forum_id = $this->request->variable('f', 0);

		return new Response($this->postmodels_listener->generate_post_models($forum_id));
	}
}
