<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Setup extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Module_model');
		}

		/**
		 * Update Site Config Data
		 */
		public function update()
		{

			// Close Site
			if (empty($_POST['site_close'])) {
				$this->db->where('config_name', 'site_close');
				$this->db->update('site_config', array('config_value' => 0));
			}

			foreach ($this->input->post() as $key => $value) {

				//Update Db
				$this->db->where('config_name', $key);
				$this->db->update('site_config', array('config_value' => $value));
			}

			redirect(base_url() . "admin/settings/setup?action=success");
		}
	}