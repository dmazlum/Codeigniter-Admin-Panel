<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Admin extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
		}

		/**
		 * Admin Login Index
		 */
		public function index()
		{
			if ($this->session->userdata('logged_in')) {
				redirect(base_url() . 'admin/dashboard');
			} else {
				$this->load->view('login/index');
			}
		}

		/**
		 * Admin Dashboard Index
		 */
		public function dashboard()
		{

			_is_logged_in();

			//Title
			$pageData['pageTitle'] = 'Dashboard';

			// Custom Scripts
			$script_data['scripts'] = array(
				0 => 'plugins/owl/owl.carousel.min.js'
			);

			// Get User Count
			$data['user_count'] = $this->db->get('co_users')->num_rows();

			// Get All News
			$data['news_count'] = $this->db->get('co_news')->num_rows();

			// Get All Gallery Section
			$data['gallery_count'] = $this->db->get('co_gallery_section')->num_rows();

			// Get All Backup
			$data['backup_count'] = $this->db->get('backup')->num_rows();

			$this->load->view('partical/header', $pageData);
			$this->load->view('dashboard', $data);
			$this->load->view('partical/footer', $script_data);
		}

		/**
		 * Admin Forgot Password Page
		 */
		public function forgot_password()
		{
			$this->load->view('login/forgot');
		}

		/**
		 * Change Current Language
		 *
		 * @param $param string
		 */
		public function change_language($param)
		{
			$this->load->library('user_agent');

			// Change registered language session key
			$this->session->set_userdata('language', $param);

			redirect($this->agent->referrer());

		}

	}