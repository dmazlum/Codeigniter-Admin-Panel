<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Login_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}

		/**
		 * Login Model
		 *
		 * @param $params string
		 * @return array
		 */
		public function getLogin($params)
		{
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where($params);

			return $this->db->get()->row_array();
		}

		/**
		 * Check Username for Forgot Password
		 *
		 * @param $username string
		 * @return int
		 */
		public function check_username($username)
		{
			$q = $this->db->get_where('users', array('username' => $username));

			return $q->result_array();
		}

		/**
		 * Check Reg Code for Forgot Password
		 *
		 * @param $code string
		 * @return int
		 */
		public function check_regcode($code)
		{
			$q = $this->db->get_where('site_config', array('config_name' => 'site_reg_code', 'config_value' => $code));

			return $q->num_rows();
		}
	}