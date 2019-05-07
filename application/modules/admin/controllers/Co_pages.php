<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Co_Pages extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->load->model('co_pages_model');
			$this->load->helper('text');
		}

		/**
		 *  Section Page
		 */
		public function sections()
		{
			_is_logged_in();

			//Title
			$pageData['pageTitle'] = 'Kategoriler & İçerikler';

			$data['section_table'] = $this->co_pages_model->fetch_menu_table($this->co_pages_model->generateTree());

			$this->load->view('partical/header', $pageData);
			$this->load->view('companents/co_pages/section/index', $data);
			$this->load->view('partical/footer');
		}

		/**
		 * Add Section Page
		 */
		public function add_section()
		{
			_is_logged_in();

			//Title
			$pageData['pageTitle'] = 'Sayfalar > Bölüm Ekleme';

			// Custom Scripts
			$script_data['scripts'] = array(
				0 => 'plugins/bootstrap/bootstrap-select.js',
				1 => 'plugins/validationengine/languages/jquery.validationEngine-tr.js',
				2 => 'plugins/validationengine/jquery.validationEngine.js',
				3 => 'plugins/slidingmenu/jquery-sliding-menu.js'
			);

			$data['all_section'] = $this->co_pages_model->fetch_menu_li($this->co_pages_model->generateTree());

			$this->load->view('partical/header', $pageData);
			$this->load->view('companents/co_pages/section/add', $data);
			$this->load->view('partical/footer', $script_data);

		}

		/**
		 * Edit Section Page
		 *
		 * @param $id int
		 */
		public function edit_section($id)
		{
			_is_logged_in();

			//Title
			$pageData['pageTitle'] = 'Kategori Güncelleme';

			// Custom Scripts
			$script_data['scripts'] = array(
				0 => 'plugins/bootstrap/bootstrap-select.js',
				1 => 'plugins/validationengine/languages/jquery.validationEngine-tr.js',
				2 => 'plugins/validationengine/jquery.validationEngine.js'
			);

			$q = $this->co_pages_model->getAllSections();

			$data['categories'] = $q[0]['children'];
			$data['edit_data'] = $this->co_pages_model->getSectionByid($id);

			$this->load->view('partical/header', $pageData);
			$this->load->view('companents/co_pages/section/edit', $data);
			$this->load->view('partical/footer', $script_data);

		}

		/**
		 * Add Section Data to Database
		 */
		public function addSectionData()
		{
			_is_logged_in();

			$data = array();

			if ($_POST) {

				foreach ($this->input->post() as $key => $value) {

					if ($key == 'section_name') {
						$data['section_slug'] = url_title(convert_accented_characters($value));
					}
					$data[$key] = $value;
				}

				$data['language'] = $this->session->userdata('language');
			}

			// Send data
			$query = $this->co_pages_model->add_section($data);

			if ($query > 0) {
				redirect('admin/co_pages/add_section?action=success');
			} else {
				redirect('admin/co_pages/add_section?action=error');
			}

		}

		/**
		 * Update Section & Content
		 *
		 * @param $id int
		 */
		public function editSectionData($id)
		{

			_is_logged_in();

			$data = array();

			if ($_POST) {

				foreach ($this->input->post() as $key => $value) {

					if ($key == 'section_name') {
						$data['section_slug'] = url_title(convert_accented_characters($value));
					}

					$data[$key] = $value;
				}
			}

			// Send data
			$query = $this->co_pages_model->update_Section($id, $data);

			if ($query > 0) {
				if ($data['section_type'] == '1') {
					redirect('admin/co_pages/edit_content/' . $id . '?action=success');
				} else {
					redirect('admin/co_pages/edit_section/' . $id . '?action=success');
				}
			} else {
				if ($data['section_type'] == '1') {
					redirect('admin/co_pages/edit_content/' . $id . '?action=error');
				} else {
					redirect('admin/co_pages/edit_section/' . $id . '?action=error');
				}
			}

		}


		/**
		 * Add Content Page
		 */
		public function add_content()
		{
			_is_logged_in();

			//Title
			$pageData['pageTitle'] = 'Sayfalar > İçerik Ekleme';

			// Custom Scripts
			$script_data['scripts'] = array(
				0 => 'plugins/bootstrap/bootstrap-select.js',
				1 => 'plugins/validationengine/languages/jquery.validationEngine-tr.js',
				2 => 'plugins/validationengine/jquery.validationEngine.js',
				3 => 'plugins/summernote/summernote.js',
				4 => 'plugins/slidingmenu/jquery-sliding-menu.js'
			);

			$data['all_section'] = $this->co_pages_model->fetch_menu_li($this->co_pages_model->generateTree());

			$this->load->view('partical/header', $pageData);
			$this->load->view('companents/co_pages/content/add', $data);
			$this->load->view('partical/footer', $script_data);

		}

		/**
		 * Edit Content Page
		 *
		 * @param $id int
		 */
		public function edit_content($id)
		{
			_is_logged_in();

			//Title
			$pageData['pageTitle'] = 'Sayfalar > İçerik Güncelleme';

			// Custom Scripts
			$script_data['scripts'] = array(
				0 => 'plugins/bootstrap/bootstrap-select.js',
				1 => 'plugins/validationengine/languages/jquery.validationEngine-tr.js',
				2 => 'plugins/validationengine/jquery.validationEngine.js',
				3 => 'plugins/summernote/summernote.js'
			);

			$q = $this->co_pages_model->getAllSections();
			$data['categories'] = $q[0]['children'];

			$data['edit_data'] = $this->co_pages_model->getSectionByid($id);

			$this->load->view('partical/header', $pageData);
			$this->load->view('companents/co_pages/content/edit', $data);
			$this->load->view('partical/footer', $script_data);

		}

		/**
		 * Add Content Data to Database
		 */
		public function addContentData()
		{
			_is_logged_in();

			$data = array();

			if ($_POST) {

				foreach ($this->input->post() as $key => $value) {

					if ($key == 'section_name') {
						$data['section_slug'] = url_title(convert_accented_characters($value));
					}
					$data[$key] = $value;
				}

				$data['language'] = $this->session->userdata('language');
			}

			// Send data
			$query = $this->co_pages_model->add_section($data);

			if ($query > 0) {
				redirect('admin/co_pages/add_content?action=success');
			} else {
				redirect('admin/co_pages/add_content?action=error');
			}

		}

		/**
		 * Delete Record
		 *
		 * @param $id int
		 */
		public function delete($id)
		{

			_is_logged_in();

			$q = $this->co_pages_model->delete_section($id);

			if ($q) {
				redirect('admin/co_pages/sections?action=success');
			} else {
				redirect('admin/co_pages/sections?action=error');
			}

		}

	}