<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	 * Admin Login Checker
	 */
	function _is_admin_login()
	{
		$CI =& get_instance();
		$user = $CI->session->userdata('is_admin');
		if (!isset($user) or $user == '') {
			redirect(base_url() . 'admin');
		}
	}

	/**
	 * User Login Checker
	 */
	function _is_logged_in()
	{
		$CI =& get_instance();
		$user = $CI->session->userdata('logged_in');
		if (!isset($user) or $user == '') {
			redirect(base_url() . 'admin');
		}
	}