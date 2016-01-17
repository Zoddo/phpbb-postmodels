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
	/** @var \phpbb\request\request */
	protected $request;

	/** @var \zoddo\postmodels\helper\helper */
	protected $helper;

	/**
	 * Constructor
	 *
	 * @param \phpbb\request\request				$request
	 * @param \zoddo\postmodels\helper\helper		$helper
	 */
	public function __construct(\phpbb\request\request $request, \zoddo\postmodels\helper\helper $helper)
	{
		$this->request = $request;
		$this->helper = $helper;
	}

	public function refresh()
	{
		$forum_id = $this->request->variable('f', 0);

		return new Response($this->helper->generate_post_models($forum_id));
	}
}
