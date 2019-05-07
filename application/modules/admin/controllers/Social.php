<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Social extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Module_model');
		}

		/**
		 * Show All
		 *
		 * @param $id int
		 */
		public function show($id)
		{
			_is_logged_in();

			$data['social_edit'] = $this->Module_model->get_module('socials', $id);

			if ($data['social_edit']) {

				$data['social'] = $this->Module_model->get_all_modules('socials');

				// Custom Scripts
				$script_data['scripts'] = array(
					0 => 'plugins/bootstrap/bootstrap-select.js',
					1 => 'plugins/validationengine/languages/jquery.validationEngine-tr.js',
					2 => 'plugins/validationengine/jquery.validationEngine.js'
				);

				$this->load->view('partical/header');
				$this->load->view('modules/social/edit', $data);
				$this->load->view('partical/footer', $script_data);

			} else {
				redirect(base_url() . 'admin/settings/social');
			}

		}

		/**
		 * Add Social Media
		 */
		public function add()
		{
			_is_logged_in();

			if ($this->input->post()) {

				$params = array(
					'social_name' => $this->input->post('social_name'),
					'social_url'  => $this->input->post('social_url'),
					'icon'        => $this->input->post('icon'),
					'status'      => $this->input->post('status')
				);

				$result = $this->Module_model->add_module('socials', $params);

				if ($result) {
					redirect(base_url() . 'admin/settings/social?action=success');
				} else {
					redirect(base_url() . 'admin/settings/social?action=error');
				}

			}

		}

		/**
		 * Update Social Media Link
		 *
		 * @param $id int
		 */
		public function update($id)
		{
			_is_logged_in();

			// check if the module exists before trying to edit it
			$module = $this->Module_model->get_module('socials', $id);

			if (isset($module['id']) && $this->input->post()) {

				$params = array(
					'social_name' => $this->input->post('social_name'),
					'social_url'  => $this->input->post('social_url'),
					'icon'        => $this->input->post('icon'),
					'status'      => $this->input->post('status')
				);

				$this->Module_model->update_module($id, 'socials', $params);
				redirect(base_url() . 'admin/settings/social?action=success');

			} else
				redirect(base_url() . 'admin/settings/social?action=error');

		}

		/**
		 * Delete Social Media Link
		 *
		 * @param $id int
		 */
		public function delete($id)
		{
			_is_logged_in();

			// check if the module exists before trying to edit it
			$module = $this->Module_model->get_module('socials', $id);

			if (isset($module['id'])) {

				$this->Module_model->delete_module('socials', $id);
				redirect(base_url() . 'admin/settings/social?action=success');
			} else {

				redirect(base_url() . 'admin/settings/social?action=error');
			}

		}
	}