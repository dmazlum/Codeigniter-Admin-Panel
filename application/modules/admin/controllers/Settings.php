<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Settings extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Module_model');
		}


		/**
		 * Modules
		 */
		public function modules()
		{
			_is_admin_login();

			//Title
			$pageData['pageTitle'] = 'Modüller';

			$params_admin = array(
				'module_type' => 0
			);

			$params_site = array(
				'module_type' => 1
			);

			$data['modules_admin'] = $this->Module_model->get_module_field('modules', $params_admin);
			$data['modules_site'] = $this->Module_model->get_module_field('modules', $params_site);

			$this->load->view('partical/header', $pageData);
			$this->load->view('modules', $data);
			$this->load->view('partical/footer');
		}

		/**
		 * Languages
		 */
		public function languages()
		{
			_is_admin_login();

			//Title
			$pageData['pageTitle'] = 'Diller';

			$data['languages'] = $this->Module_model->get_all_modules('languages');

			$this->load->view('partical/header', $pageData);
			$this->load->view('modules/languages/index', $data);
			$this->load->view('partical/footer');
		}

		/**
		 * Socials
		 */
		public function social()
		{
			_is_logged_in();

			//Title
			$pageData['pageTitle'] = 'Sosyal Medya';

			$data['social'] = $this->Module_model->get_all_modules('socials');

			// Custom Scripts
			$script_data['scripts'] = array(
				0 => 'plugins/bootstrap/bootstrap-select.js',
				1 => 'plugins/validationengine/languages/jquery.validationEngine-tr.js',
				2 => 'plugins/validationengine/jquery.validationEngine.js'
			);

			$this->load->view('partical/header', $pageData);
			$this->load->view('modules/social/index', $data);
			$this->load->view('partical/footer', $script_data);
		}

		/**
		 * Users
		 */
		public function users()
		{
			_is_admin_login();

			//Title
			$pageData['pageTitle'] = 'Kullanıcılar';

			$data['users'] = $this->Module_model->get_all_modules('users', 'role');

			// Custom Scripts
			$script_data['scripts'] = array(
				0 => 'plugins/bootstrap/bootstrap-select.js',
				1 => 'plugins/validationengine/languages/jquery.validationEngine-tr.js',
				2 => 'plugins/validationengine/jquery.validationEngine.js'
			);

			$this->load->view('partical/header', $pageData);
			$this->load->view('modules/users/index', $data);
			$this->load->view('partical/footer', $script_data);
		}

		/**
		 * Backup
		 */
		public function backup()
		{
			_is_admin_login();

			//Title
			$pageData['pageTitle'] = 'Yedek İşlemleri';

			$data['backups'] = $this->Module_model->get_all_modules('backup');

			$this->load->view('partical/header', $pageData);
			$this->load->view('modules/backup/index', $data);
			$this->load->view('partical/footer');
		}

		/**
		 * Site General Setup
		 */
		public function setup()
		{
			_is_admin_login();

			//Title
			$pageData['pageTitle'] = 'Site Ayarları';

			$data['site_config'] = $this->Module_model->get_all_modules('site_config');

			// Custom Scripts
			$script_data['scripts'] = array(
				0 => 'plugins/icheck/icheck.min.js',
				1 => 'plugins/bootstrap/bootstrap-select.js'
			);

			$this->load->view('partical/header', $pageData);
			$this->load->view('modules/setup/index', $data);
			$this->load->view('partical/footer', $script_data);
		}

	}