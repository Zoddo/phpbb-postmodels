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
use phpbb\auth\auth;
use phpbb\db\driver\driver_interface;
use phpbb\request\request;
use phpbb\template\template;
use phpbb\user;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use zoddo\postmodels\constants;

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

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var string */
	protected $table_prefix;

	/**
	 * Constructor
	 *
	 * @param \phpbb\db\driver\driver_interface		$db				Database object
	 * @param \phpbb\user							$user			User object
	 * @param \phpbb\auth\auth						$auth			Auth object
	 * @param \phpbb\template\template				$template		Template object
	 * @param \phpbb\request\request				$request		Request object
	 * @param \phpbb\controller\helper				$helper			Helper object
	 * @param string								$table_prefix	Tables prefix
	 */
	public function __construct(driver_interface $db, user $user, auth $auth, template $template, request $request, \phpbb\controller\helper $helper, $table_prefix)
	{
		$this->db = $db;
		$this->user = $user;
		$this->auth = $auth;
		$this->template = $template;
		$this->request = $request;
		$this->helper = $helper;
		$this->table_prefix = $table_prefix;
	}

	/**
	 * Adds permissions
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

	/**
	 * Assigns template vars for posting
	 *
	 * @param object	$event			The event object
	 */
	public function add_posting_vars($event)
	{
		$this->generate_post_models($event['forum_id']);
	}

	/**
	 * Assigns template vars for PMs
	 */
	public function add_pm_vars()
	{
		$this->generate_post_models();
	}

	public function generate_post_models($forum_id = 0)
	{
		$this->user->add_lang_ext('zoddo/postmodels', 'post_models');
		$selected_language = basename($this->request->variable('selected_language', $this->user->data['user_lang']));

		$s_post_model = $s_language = $button = '';
		$total_models = $total_language = 0;

		//Are we in private messaging ?
		if (!$forum_id || empty($forum_id))
		{
			$s_auth_model = ($this->auth->acl_get('u_pm_models')) ? true : false;
			$sql_where_auth = 'm.model_pm = 1';
		}
		else
		{

			$s_auth_model = ($this->auth->acl_get('f_models', $forum_id)) ? true : false;
			$sql_where_auth = 'm.model_pm >= 0';
		}

		//I have auth permission to use models
		if ($s_auth_model)
		{
			//Can I use post models founder/admin/mod ?
			if ($this->user->data['user_type'] == USER_FOUNDER)
			{
				$sql_where_auth .= ' AND m.model_auth <= ' . constants::MODEL_FOUNDERS;
			}
			else if ($this->auth->acl_get('a_'))
			{
				$sql_where_auth .= ' AND m.model_auth <= ' . constants::MODEL_ADMINISTRATORS;
			}
			else if ($this->auth->acl_get('m_', $forum_id))
			{
				$sql_where_auth .= ' AND m.model_auth <= ' . constants::MODEL_MODERATORS;
			}
			else
			{
				$sql_where_auth .= ' AND m.model_auth = ' . constants::MODEL_USERS;
			}

			$postrow = array();

			$sql = "SELECT m.model_title, m.model_content, m.model_lang, l.lang_local_name
		   	FROM " . $this->table_prefix . "models m
			LEFT JOIN  " . LANG_TABLE ." l ON (m.model_lang = l.lang_iso)
			WHERE " . $sql_where_auth . "
			AND m.model_lang = l.lang_iso
			ORDER BY model_title, model_lang";
			$result = $this->db->sql_query($sql);

			while ($row = $this->db->sql_fetchrow($result))
			{
				$postrow[] = $row;
			}
			$this->db->sql_freeresult($result);
			$total_models = sizeof($postrow);

			$s_post_model = '<select id="post_model" name="post_model">';

			if ($total_models)
			{
				//Check if models exist in default language of user
				$default_language = false;
				foreach ($postrow as $row)
				{
					foreach ($row as $cell)
					{
						if ($cell == $this->user->data['user_lang'] && ($default_language == false))
						{
							$default_language = true;
						}
					}
				}

				$selected_language = ($default_language) ? $selected_language : $postrow[0]['model_lang'];

				$s_post_model .= '<option value="">' . $this->user->lang['SELECT_MODEL'] . '</option>';
				$s_language .= '<select id="selected_language" name="selected_language" onchange="models_refresh(\''.$forum_id.'\', this.value);">';
				for ($i = 0; $i < $total_models; $i++)
				{
					//Don't add a language in duplicate
					if (!preg_match('#<option value="' . $postrow[$i]['model_lang'] . '"#', $s_language))
					{
						$selected = ($postrow[$i]['model_lang'] == $selected_language) ? ' selected="selected"' : '';
						$s_language .= '<option value="' . $postrow[$i]['model_lang'] . '"' . $selected . '>' . $postrow[$i]['lang_local_name'] . '</option>';
						$total_language++;
					}

					if ($postrow[$i]['model_lang'] == $selected_language)
					{
						$value = $postrow[$i]['model_content'];
						$s_post_model .= '<option value="' . $value . '">&nbsp;-&nbsp;' . $postrow[$i]['model_title'] . '</option>';
					}
				}
				$s_language .= '</select>';
			}
			$s_post_model .= '</select>';
			$button = '<input type="button" class="button2" name="insert_post_model" value="'. $this->user->lang['INSERT'] .'" style="width: 70px" onclick="insert_text(post_model.value)" />';
		}

		$this->template->assign_vars(array(
			'BUTTON'					=> $button,
			'S_AUTH_MODEL'				=> $s_auth_model,
			'S_LANGUAGE'				=> $s_language,
			'S_POST_MODEL'				=> $s_post_model,
			'S_TOTAL_MODEL'				=> $total_models,
			'S_TOTAL_LANGUAGE'			=> ($total_language > 1) ? true : false,
			'U_AJAX_REFRESH'			=> $this->helper->route('zoddo_postmodels_refresh'),
		));

		return $s_language . '&nbsp;' . $s_post_model .'&nbsp;' . $button;
	}
}
