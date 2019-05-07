<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class User extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Module_model');
		}


		/**
		 * Show for Edit
		 *
		 * @param $id int
		 */
		public function show($id)
		{
			_is_admin_login();

			//Title
			$pageData['pageTitle'] = 'Kullanıcılar';

			$data['user_edit'] = $this->Module_model->get_module('users', $id);

			if ($data['user_edit']) {

				$data['users'] = $this->Module_model->get_all_modules('users', 'role');

				// Custom Scripts
				$script_data['scripts'] = array(
					0 => 'plugins/bootstrap/bootstrap-select.js',
					1 => 'plugins/validationengine/languages/jquery.validationEngine-tr.js',
					2 => 'plugins/validationengine/jquery.validationEngine.js'
				);

				$this->load->view('partical/header', $pageData);
				$this->load->view('modules/users/edit', $data);
				$this->load->view('partical/footer', $script_data);

			} else {
				redirect('admin/settings/users');
			}

		}

		/**
		 * Add
		 */
		public function add()
		{
			_is_admin_login();

			if ($this->input->post()) {

				$params = array(
					'name_surname'  => $this->input->post('name_surname'),
					'username'      => $this->input->post('username'),
					'password'      => md5(sha1($this->input->post('password'))),
					'email_address' => $this->input->post('email'),
					'role'          => $this->input->post('role')
				);

				$result = $this->Module_model->add_module('users', $params);

				if ($result) {
					redirect('admin/settings/users?action=success');
				} else {
					redirect('admin/settings/users?action=error');
				}

			}

		}

		/**
		 * Update Record
		 *
		 * @param $id int
		 */
		public function update($id)
		{
			_is_admin_login();

			// check if the module exists before trying to edit it
			$module = $this->Module_model->get_module('users', $id);

			if (isset($module['id']) && $this->input->post()) {

				if ($this->input->post('password')) {

					$params = array(
						'name_surname'  => $this->input->post('name_surname'),
						'username'      => $this->input->post('username'),
						'password'      => md5(sha1($this->input->post('password'))),
						'email_address' => $this->input->post('email'),
						'role'          => $this->input->post('role')
					);

				} else {

					$params = array(
						'name_surname'  => $this->input->post('name_surname'),
						'username'      => $this->input->post('username'),
						'email_address' => $this->input->post('email'),
						'role'          => $this->input->post('role')
					);
				}

				$this->Module_model->update_module($id, 'users', $params);
				redirect('admin/settings/users?action=success');

			} else
				redirect('admin/settings/users?action=error');

		}

		/**
		 * Delete Record
		 *
		 * @param $id int
		 */
		public function delete($id)
		{
			_is_admin_login();

			// check if the module exists before trying to edit it
			$module = $this->Module_model->get_module('users', $id);

			if (isset($module['id'])) {

				$this->Module_model->delete_module('users', $id);
				redirect('admin/settings/users?action=success');
			} else {
				redirect('admin/settings/users?action=error');
			}

		}
	}