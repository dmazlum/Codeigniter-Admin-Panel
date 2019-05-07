<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Co_users extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('co_users_model');
		}

		/**
		 * List All Site Users
		 */
		public function list_user()
		{
			_is_admin_login();

			//Title
			$pageData['pageTitle'] = 'Kullanıcı İşlemleri';

			$data['users'] = $this->co_users_model->get_all_users();

			// Custom Scripts
			$script_data['scripts'] = array(
				0 => 'plugins/bootstrap/bootstrap-select.js',
				1 => 'plugins/validationengine/languages/jquery.validationEngine-tr.js',
				2 => 'plugins/validationengine/jquery.validationEngine.js'
			);

			$this->load->view('partical/header', $pageData);
			$this->load->view('companents/co_users/index', $data);
			$this->load->view('partical/footer', $script_data);
		}

		/**
		 * Add Site User
		 */
		public function add_user()
		{
			_is_admin_login();

			if ($this->input->post()) {

				$params = array(
					'name_surname'  => $this->input->post('name_surname'),
					'username'      => $this->input->post('username'),
					'password'      => md5(sha1($this->input->post('password'))),
					'email_address' => $this->input->post('email'),
					'status'        => $this->input->post('status'),
					'role'          => $this->input->post('role'),
					'reset_date'    => '0000-00-00 00:00:00'
				);

				$result = $this->co_users_model->add_users($params);

				if ($result) {
					redirect('admin/co_users/list_user?action=success');
				} else {
					redirect('admin/co_users/list_user?action=error');
				}

			}

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
			$pageData['pageTitle'] = 'Kullanıcı Güncelleme';

			$data['user_edit'] = $this->co_users_model->get_user($id);

			if ($data['user_edit']) {

				$data['users'] = $this->co_users_model->get_all_users();

				// Custom Scripts
				$script_data['scripts'] = array(
					0 => 'plugins/bootstrap/bootstrap-select.js',
					1 => 'plugins/validationengine/languages/jquery.validationEngine-tr.js',
					2 => 'plugins/validationengine/jquery.validationEngine.js'
				);

				$this->load->view('partical/header', $pageData);
				$this->load->view('companents/co_users/edit', $data);
				$this->load->view('partical/footer', $script_data);

			} else {
				redirect('admin/co_users/list_user');
			}

		}

		/**
		 * Update User Record
		 *
		 * @param $id int
		 */
		public function update($id)
		{
			_is_admin_login();

			$module = $this->co_users_model->get_user($id);

			if (isset($module['id']) && $this->input->post()) {

				if ($this->input->post('password')) {

					$params = array(
						'name_surname'  => $this->input->post('name_surname'),
						'username'      => $this->input->post('username'),
						'password'      => md5(sha1($this->input->post('password'))),
						'email_address' => $this->input->post('email'),
						'role'          => $this->input->post('role'),
						'status'        => $this->input->post('status')
					);

				} else {

					$params = array(
						'name_surname'  => $this->input->post('name_surname'),
						'username'      => $this->input->post('username'),
						'email_address' => $this->input->post('email'),
						'role'          => $this->input->post('role'),
						'status'        => $this->input->post('status')
					);
				}

				$this->co_users_model->update_user($id, $params);

				redirect('admin/co_users/list_user?action=success');

			} else
				redirect('admin/co_users/list_user?action=error');

		}

		/**
		 * Delete User Record
		 *
		 * @param $id int
		 */
		public function delete($id)
		{
			_is_admin_login();

			$module = $this->co_users_model->get_user($id);

			if (isset($module['id'])) {

				$this->co_users_model->delete_user($id);

				redirect('admin/co_users/list_user?action=success');
			} else {
				redirect('admin/co_users/list_user?action=error');
			}

		}

	}