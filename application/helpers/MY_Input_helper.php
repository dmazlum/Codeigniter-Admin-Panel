<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	if (!function_exists('get_status')) {

		function get_status($selected)
		{
			$status = array(
				'Aktif'   => 1,
				'Deaktif' => 0
			);

			foreach ($status as $key => $value) {

				if ($selected == $value) {
					$select = "selected";
				} else {
					$select = "";
				}

				echo '<option value="' . $value . '" ' . $select . '>' . $key . '</option>' . PHP_EOL;
			}
		}

	}


	if (!function_exists('get_icons')) {

		function get_icons($selected)
		{

			// Dropdown
			$icons = array(
				'Facebook'  => 'fa-facebook-square',
				'Twitter'   => 'fa-twitter',
				'Google+'   => 'fa-google-plus-square',
				'Instagram' => 'fa-instagram',
				'Linkedin'  => 'fa-linkedin-square',
				'Pinterest' => 'fa-pinterest-square',
				'Vimeo'     => 'fa-vimeo-square',
				'Youtube'   => 'fa-youtube-square'
			);

			foreach ($icons as $key => $value) {

				if ($selected == $value) {
					$select = "selected";
				} else {
					$select = "";

				}

				echo '<option value="' . $value . '" ' . $select . '>' . $key . '</option>' . PHP_EOL;
			}
		}

	}

	if (!function_exists('get_role')) {

		function get_role($selected)
		{

			// Dropdown
			$icons = array(
				'Yönetici'  => 'admin',
				'Kullanıcı' => 'user'
			);

			foreach ($icons as $key => $value) {

				if ($selected == $value) {
					$select = "selected";
				} else {
					$select = "";

				}

				echo '<option value="' . $value . '" ' . $select . '>' . $key . '</option>' . PHP_EOL;
			}
		}

	}

	if (!function_exists('get_language')) {

		function get_language($selected)
		{

			$CI =& get_instance();
			$CI->load->database();

			$CI->db->where('status', 1);
			$lang_query = $CI->db->get('languages');

			$status = array();

			foreach ($lang_query->result_array() as $lang) {
				$status[] = $lang;
			}

			foreach ($status as $key => $value) {

				if ($selected == $value['iso_code']) {
					$select = "selected";
				} else {
					$select = "";
				}

				echo '<option value="' . $value['iso_code'] . '" ' . $select . '>' . $value['language'] . '</option>' . PHP_EOL;
			}
		}

	}
