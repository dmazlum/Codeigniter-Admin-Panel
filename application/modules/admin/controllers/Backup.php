<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Backup extends CI_Controller
	{


		/**
		 * Backup Index Page
		 */
		public function index()
		{

			_is_admin_login();

			// Helpers
			$this->load->dbutil();
			$this->load->helper('download');
			$this->load->helper('file');

			$prefs = array(
				'format'   => 'zip',
				'filename' => 'my_db_backup.sql'
			);

			$backup =& $this->dbutil->backup($prefs);

			$db_name = 'backup-on-' . date("Y-m-d-H-i-s") . '.zip';
			$save = 'backups/' . $db_name;

			// Write file
			write_file($save, $backup);

			// Save to Database
			$params = array(
				'id'              => rand(750, 9999),
				'backup_name'     => $db_name,
				'backup_location' => 'backups'

			);
			$this->db->insert('backup', $params);

			// Download
			//force_download($db_name, $backup);

			// Redirect
			redirect(base_url() . 'admin/settings/backup');
		}

		/**
		 * Delete Backup File
		 *
		 * @param $id int
		 */
		public function delete($id)
		{
			_is_admin_login();

			$this->load->model('Module_model');

			// check if the module exists before trying to edit it
			$module = $this->Module_model->get_module('backup', $id);

			if (isset($module['id'])) {

				$this->Module_model->delete_module('backup', $id);

				// Delete File
				unlink($module['backup_location'] . "/" . $module['backup_name']);

				redirect(base_url() . 'admin/settings/backup');

			}

		}

	}