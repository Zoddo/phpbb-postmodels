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

use zoddo\postmodels\constants;

class models_module
{
	public $u_action;

	public function main($id, $mode)
	{
		/** @var \phpbb\request\request $request */
		/** @var \phpbb\log\log $phpbb_log */
		global $config, $db, $user, $template, $request, $phpbb_log;
		global $table_prefix, $phpbb_root_path, $phpEx;

		include_once($phpbb_root_path . 'includes/functions_display.' . $phpEx);
		$user->add_lang('posting');
		$user->add_lang_ext('zoddo/postmodels', 'models_acp');

		// Set up general vars
		$action = $request->variable('action', '');
		$submit = $request->is_set_post('submit');
		$model_id = $request->variable('id', 0);

		$this->tpl_name = 'models_manage';
		$this->page_title = 'ACP_MODELS';

		$form_name = 'acp_models';
		add_form_key('acp_models');

		$error = array();
		switch ($action)
		{
			case 'add':
			case 'edit':

				$model_row = array(
					'model_title'			=> $request->variable('model_title', '', true),
					'model_content'			=> $request->variable('model_content', '', true),
					'model_auth'			=> $request->variable('model_auth', 0),
					'model_pm'				=> $request->variable('model_pm', 0),
					'model_lang'			=> $request->variable('model_lang', '', true),
				);

				if ($submit)
				{
					if (!check_form_key($form_name))
					{
						$error[] = $user->lang['FORM_INVALID'];
					}
					// Model specified?
					if (!$model_row['model_title'] || !$model_row['model_content'] || !$model_row['model_lang'])
					{
						$error[] = $user->lang['NO_MODEL_INFO'];
					}

					$check_double = ($action == 'add') ? true : false;

					if ($action == 'edit')
					{
						$sql = 'SELECT model_title
							FROM ' . $table_prefix . "models
							WHERE model_id = " . (int) $model_id;
						$result = $db->sql_query($sql);
						$row = $db->sql_fetchrow($result);
						$db->sql_freeresult($result);

						if ($row['model_title'] != $model_row['model_title'])
						{
							$check_double = true;
						}
					}

					// Check for same model if adding it...
					if ($check_double)
					{
						$sql = 'SELECT model_id
							FROM ' . $table_prefix . "models
							WHERE model_title = '" . $db->sql_escape($model_row['model_title']) . "'
								AND model_lang = '" . $db->sql_escape($model_row['model_lang']) . "'";
						$result = $db->sql_query($sql);
						$row = $db->sql_fetchrow($result);
						$db->sql_freeresult($result);

						if ($row)
						{
							$error[] = $user->lang['MODEL_ALREADY_EXIST'];
						}
					}

					if (!sizeof($error))
					{
						// New model?
						if ($action == 'add')
						{
							$sql_ary = array(
								'model_title'		=> (string) $model_row['model_title'],
								'model_content'		=> (string) $model_row['model_content'],
								'model_auth'		=> (int) $model_row['model_auth'],
								'model_pm'			=> (int) $model_row['model_pm'],
								'model_lang'		=> (string) $model_row['model_lang'],
							);

							$db->sql_query('INSERT INTO ' . $table_prefix . 'models ' . $db->sql_build_array('INSERT', $sql_ary));

							$log = 'ADDED';
						}
						else if ($model_id)
						{
							$sql_ary = array(
								'model_title'		=> (string) $model_row['model_title'],
								'model_content'		=> (string) $model_row['model_content'],
								'model_auth'		=> (int) $model_row['model_auth'],
								'model_pm'			=> (int) $model_row['model_pm'],
								'model_lang'		=> (string) $model_row['model_lang'],
							);

							$db->sql_query('UPDATE ' . $table_prefix . 'models SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
								WHERE model_id = ' . (int) $model_id);

							$log = 'UPDATED';
						}

						$phpbb_log->add('admin', $user->data['user_id'], $user->ip, 'LOG_MODEL_' . $log, time(), array($model_row['model_title']));
						trigger_error($user->lang['MODEL_' . $log] . adm_back_link($this->u_action));
					}
				}
				else if ($model_id)
				{
					$sql = 'SELECT *
						FROM ' . $table_prefix . 'models
						WHERE model_id = ' . (int) $model_id;
					$result = $db->sql_query($sql);
					$model_row = $db->sql_fetchrow($result);
					$db->sql_freeresult($result);

					if (!$model_row)
					{
						trigger_error($user->lang['NO_MODEL'] . adm_back_link($this->u_action), E_USER_WARNING);
					}
				}

				$l_title = ($action == 'edit') ? 'EDIT' : 'ADD';
				$default_language = ($action == 'edit') ? $model_row['model_lang'] : $user->data['user_lang'];

				$s_selected_users = $s_selected_mod = $s_selected_admin = $s_selected_founders = '';

				if ($model_row['model_auth'] == constants::MODEL_USERS)
				{
					$s_selected_users = 'selected="selected"';
				}
				else if ($model_row['model_auth'] == constants::MODEL_MODERATORS)
				{
					$s_selected_mod = 'selected="selected"';
				}
				else if ($model_row['model_auth'] == constants::MODEL_ADMINISTRATORS)
				{
					$s_selected_admin = 'selected="selected"';
				}
				else if ($model_row['model_auth'] == constants::MODEL_FOUNDERS)
				{
					$s_selected_founders = 'selected="selected"';
				}

				$template->assign_vars(array(
						'L_TITLE'		=> $user->lang['MODEL_' . $l_title],
						'U_ACTION'		=> $this->u_action . "&amp;id=$model_id&amp;action=$action",
						'U_BACK'		=> $this->u_action,
						'ERROR_MSG'		=> (sizeof($error)) ? implode('<br />', $error) : '',

						'MODEL_TITLE'			=> $model_row['model_title'],
						'MODEL_CONTENT'			=> $model_row['model_content'],
						'MODEL_PM'				=> $model_row['model_pm'],
						'S_MODEL_LANG'			=> language_select($default_language),
						'S_SELECTED_USERS'		=> $s_selected_users,
						'S_SELECTED_MOD'		=> $s_selected_mod,
						'S_SELECTED_ADMIN'		=> $s_selected_admin,
						'S_SELECTED_FOUNDERS'	=> $s_selected_founders,

						'S_EDIT_MODEL'			=> true,
						'S_ERROR'				=> (sizeof($error)) ? true : false,

						'S_BBCODE_QUOTE'		=> true,
						'S_BBCODE_IMG'			=> true,
						'S_LINKS_ALLOWED'		=> $config['allow_post_links'] ? true : false,
						'S_BBCODE_FLASH'		=> $config['allow_post_flash'] ? true : false,
				));

				display_custom_bbcodes();

				return;
				break;

			case 'delete':

				$sql = 'SELECT *
					FROM ' . $table_prefix . 'models
					WHERE model_id = ' . (int) $model_id;
				$result = $db->sql_query($sql);
				$model_row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				if (!$model_row)
				{
					trigger_error($user->lang['NO_MODEL'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				// Let the deletion be confirmed...
				if (confirm_box(true))
				{
					$db->sql_query('DELETE FROM ' . $table_prefix . 'models WHERE model_id = ' . (int) $model_id);

					$phpbb_log->add('admin', $user->data['user_id'], $user->ip, 'LOG_MODEL_REMOVED', time(), array($model_row['model_title']));
					trigger_error($user->lang['MODEL_REMOVED'] . adm_back_link($this->u_action));
				}
				else
				{
					confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
							'i'			=> $id,
							'mode'		=> $mode,
							'action'	=> $action,
							'id'		=> $model_id
					)));
				}

				break;
		}

		$sql = "SELECT lang_iso
			FROM " . \LANG_TABLE . "
			ORDER BY lang_english_name";
		$result = $db->sql_query($sql, 600);

		$language = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$language[] = $row['lang_iso'];
		}
		$db->sql_freeresult($result);

		$sql = "SELECT model_id, model_title, model_auth, model_pm, model_lang
			FROM " . $table_prefix . "models
			ORDER BY model_title ASC";
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$model_auth = array($user->lang['USERS'], $user->lang['MODERATORS'], $user->lang['ADMINISTRATORS'], $user->lang['FOUNDERS']);
			$no_exist = (in_array($row['model_lang'], $language)) ? false : true;

			$template->assign_block_vars('models', array(
					'MODEL_TITLE'	=> $row['model_title'],
					'MODEL_AUTH'	=> $model_auth[$row['model_auth']],
					'MODEL_PM'		=> $row['model_pm'] ? $user->lang['YES'] : $user->lang['NO'],
					'MODEL_LANG'	=> $row['model_lang'],
					'MODEL_EXIST'	=> ($no_exist == true) ? $user->lang['NO_EXIST'] : '',

					'U_EDIT'		=> $this->u_action . '&amp;action=edit&amp;id=' . $row['model_id'],
					'U_DELETE'		=> $this->u_action . '&amp;action=delete&amp;id=' . $row['model_id'],)
			);
		}
		$db->sql_freeresult($result);
	}
}
