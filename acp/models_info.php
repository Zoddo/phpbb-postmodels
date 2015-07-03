<?php
/**
 *
 * @package Post Models Extension
 * @copyright (c) 2015 Zoddo <zoddo.ino@gmail.com>
 * @copyright (c) 2007 Elglobo <http://www.phpbb-services.com>
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace zoddo\postmodels\acp;

class models_info
{
	public function module()
	{
		return array(
			'filename'			=> '\zoddo\postmodels\acp\models_module',
			'title'				=> 'ACP_MODELS',
			'modes'				=> array(
				'main'					=> array('title' => 'ACP_MODELS', 'auth' => 'ext_zoddo/postmodels && acl_a_models', 'cat' => array('ACP_MESSAGES')),
			),
		);
	}
}
