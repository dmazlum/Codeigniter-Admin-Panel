<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Module extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->model('Module_model');
		}

		/*
		 * Editing a module
		 */
		function edit($id, $status)
		{

			_is_admin_login();

			// check if the module exists before trying to edit it
			$module = $this->Module_model->get_module('modules', $id);

			if (isset($module['id'])) {

				$params = array(
					'status' => $status,
				);

				$this->Module_model->update_module($id, 'modules', $params);
				redirect(base_url() . 'admin/settings/modules');

			} else
				show_error('The module you are trying to edit does not exist.');
		}

	}
