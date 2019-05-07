<?php
	defined('BASEPATH') OR exit('No direct script access allowed');


	if (!function_exists('get_modules')) {

		/**
		 * Get Admin Modules
		 *
		 * @return array
		 */
		function get_modules()
		{

			$data = array();
			$ci = &get_instance();

			$ci->db->where('module_type', 0);
			$ci->db->order_by('module_id', 'ASC');
			$query = $ci->db->get('modules');

			foreach ($query->result_array() as $row) {

				// Check Admin Permission -> Show All Menu
				if ($ci->session->userdata('is_admin')) {
					$data[] = $row;
				}

				// Check User Permission
				if ($ci->session->userdata('is_user')) {
					if ($row['permission'] == 'user') {
						$data[] = $row;
					}
				}
			}

			return $data;
		}

	}

	if (!function_exists('get_site_modules')) {

		/**
		 * Get Site Modules
		 *
		 * @return array
		 */
		function get_site_modules()
		{

			$data = array();
			$ci = &get_instance();

			$ci->load->helper('file');

			$ci->db->where('module_type', 1);
			$ci->db->order_by('module_id', 'ASC');
			$query = $ci->db->get('modules');

			foreach ($query->result_array() as $row) {

				// Check Admin Permission -> Show All Menu
				if ($ci->session->userdata('is_admin')) {
					$data[] = $row;
				}

				// Check User Permission
				if ($ci->session->userdata('is_user')) {
					if ($row['permission'] == 'user') {
						$data[] = $row;
					}
				}
			}

			return $data;
		}

	}

	if (!function_exists('vertical_menu')) {

		/**
		 * Vertical Menu
		 */
		function vertical_menu()
		{
			$ci = &get_instance();
			$ci->load->database();

			// Get Language
			$ci->db->where('status', 1);
			$lang_query = $ci->db->get('languages');

			$lang_data = array();

			foreach ($lang_query->result_array() as $lang) {
				$lang_data[] = $lang;
			}

			$data['language'] = $lang_data;
			$data['current_lang'] = $ci->session->userdata('language');

			// Check Site is closed?
			$ci->db->where('config_name', 'site_close');
			$ci->db->where('config_value', 1);
			$q = $ci->db->get('site_config');

			if ($q->num_rows()) {
				$data['site_closed'] = true;
			} else {
				$data['site_closed'] = false;
			}

			$ci->load->view('partical/vertical_menu', $data);
		}

	}