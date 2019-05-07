<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	 * Class CO_Gallery
	 */
	class Co_gallery extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->load->model('co_gallery_model');
			$this->load->library('upload');
			$this->load->library('image_lib');
		}

		private $max_width = 1280;
		private $max_height = 720;
		private $max_size = 6144;
		private $per_page = 20;

		/**
		 * Gallery Section Page
		 *
		 * @param null $id int
		 */
		public function sections($id = NULL)
		{
			_is_logged_in();

			//Title
			$pageData['pageTitle'] = 'Galeri Kategorileri';

			// Custom Scripts
			$script_data['scripts'] = array(
				0 => 'plugins/blueimp/jquery.blueimp-gallery.min.js',
				1 => 'plugins/icheck/icheck.min.js',
				2 => 'plugins/validationengine/languages/jquery.validationEngine-tr.js',
				3 => 'plugins/validationengine/jquery.validationEngine.js',
				4 => 'plugins/bootstrap/bootstrap-select.js',
				5 => 'plugins/fileinput/fileinput.min.js',
				6 => 'plugins/dropzone/dropzone.min.js',
				7 => 'gallery.js'
			);

			// Get All Section Gallery
			$data['section_gallery'] = $this->co_gallery_model->getAllSectionGallery();
			$data['current_lang'] = $this->session->userdata('language');

			if ($id !== NULL) {
				// Get By Id
				$data['galleryById'] = $this->co_gallery_model->getById($id);
			}

			$this->load->view('partical/header', $pageData);
			$this->load->view('companents/co_gallery/section/index', $data);
			$this->load->view('partical/footer', $script_data);
		}

		/**
		 * Add Gallery Section Data to Database
		 */
		public function addSectionData()
		{
			_is_logged_in();

			$data = array();

			if ($_POST) {

				foreach ($this->input->post() as $key => $value) {

					if ($key == 'section_name') {
						$data['section_slug'] = url_title($value);
					}
					$data[$key] = $value;
				}

				// Upload Photo
				$config['upload_path'] = './gallery/sections/';
				$config['allowed_types'] = 'jpg|png';
				$config['max_size'] = $this->max_size;
				$config['encrypt_name'] = true;

				$this->upload->initialize($config);
				$this->upload->do_upload('section_photo');

				$data['section_photo'] = $this->upload->data('file_name');
			}

			// Send data
			$query = $this->co_gallery_model->add_section($data);

			if ($query > 0 && $this->upload->data('file_name')) {
				redirect('admin/co_gallery/sections?action=success');
			} else {
				redirect('admin/co_gallery/sections?action=error');
			}

		}

		/**
		 * Edit Gallery Section Data to Database
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
						$data['section_slug'] = url_title($value);
					}
					$data[$key] = $value;
				}

				// Upload Photo
				$config['upload_path'] = './gallery/sections/';
				$config['allowed_types'] = 'jpg|png';
				$config['max_size'] = $this->max_size;
				$config['encrypt_name'] = true;

				$this->upload->initialize($config);
				$this->upload->do_upload('section_photo');

				// Check Photo
				if ($this->upload->data('file_name')) {

					// Delete old file
					$this->db->where('id', $id);
					$q = $this->db->get('co_gallery_section');
					$photo = $q->result_array();

					unlink($config['upload_path'] . $photo[0]['section_photo']);

					$data['section_photo'] = $this->upload->data('file_name');
				}
			}

			// Send data
			$query = $this->co_gallery_model->edit_section($id, $data);

			if ($query > 0) {
				redirect('admin/co_gallery/sections?action=success');
			} else {
				redirect('admin/co_gallery/sections?action=error');
			}

		}

		/**
		 * Delete Gallery Sections
		 *
		 * @param $type string
		 */
		public function deleteSectionData($type = NULL)
		{

			//todo: galeri bölümünde foto varsa uyarı ver silme

			_is_logged_in();

			if ($_POST && !$type) {

				$check_photo = $this->co_gallery_model->checkPhoto($this->input->post('id', true));

				if ($check_photo == 0) {
					$this->co_gallery_model->delete_section($this->input->post('id', true));
					echo "ok";
				} else {
					echo base_url() . 'admin/co_gallery/sections?action=notdelete';
				}
			}

			// Bulk Delete
			if ($_POST && $type == 'bulk') {

				$getCount = count($_POST['DeleteData']);

				$i = 0;
				foreach ($_POST['DeleteData'] as $value) {

					$check_photo = $this->co_gallery_model->checkPhoto($value['id']);

					if (!$check_photo) {
						$i = $i + 1;

						$this->co_gallery_model->delete_section($value['id']);
						echo "ok";
					} else {
						echo base_url() . 'admin/co_gallery/sections?action=notdelete';
					}
				}

				if ($getCount == $i) {
					echo "redirect";
				}
			}

		}

		/**
		 * Gallery Content Page
		 *
		 * @param null $id
		 */
		public function content($id = NULL)
		{
			_is_logged_in();

			$this->load->library('pagination');

			//Title
			$pageData['pageTitle'] = 'Galeri > Fotoğraf Ekleme';

			// Custom Scripts
			$script_data['scripts'] = array(
				0 => 'plugins/blueimp/jquery.blueimp-gallery.min.js',
				1 => 'plugins/icheck/icheck.min.js',
				2 => 'plugins/validationengine/languages/jquery.validationEngine-tr.js',
				3 => 'plugins/validationengine/jquery.validationEngine.js',
				4 => 'plugins/bootstrap/bootstrap-select.js',
				5 => 'plugins/fileinput/fileinput.min.js',
				6 => 'plugins/dropzone/dropzone.min.js',
				7 => 'gallery.js'
			);

			// Get All Section Gallery
			$data['section_gallery'] = $this->co_gallery_model->getAllSectionCount();

			if ($id !== NULL) {

				// Pagination
				$config['base_url'] = base_url() . 'admin/co_gallery/content/' . $id;
				$config['total_rows'] = count($this->co_gallery_model->getPhotosById($id, NULL, NULL));
				$config['per_page'] = $this->per_page;
				$config['uri_segment'] = 5;
				//$config['num_links'] = round($config['total_rows'] / $config['per_page']);

				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['next_link'] = '»';
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';
				$config['prev_link'] = '«';

				$this->pagination->initialize($config);
				$data['pagination'] = $this->pagination->create_links();

				$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

				$data['show_photos'] = $this->co_gallery_model->getPhotosById($id, $config['per_page'], $page);
			}

			$this->load->view('partical/header', $pageData);
			$this->load->view('companents/co_gallery/content/index', $data);
			$this->load->view('partical/footer', $script_data);
		}


		/**
		 * Add new Photos to Gallery
		 *
		 * @param $id int
		 */
		public function addPhoto($id)
		{

			_is_logged_in();

			// Upload Photo
			$configUpload['upload_path'] = './gallery/';
			$configUpload['allowed_types'] = 'jpg|png';
			$configUpload['max_size'] = $this->max_size;
			$configUpload['encrypt_name'] = true;

			$this->upload->initialize($configUpload);

			$data = array();

			foreach ($_FILES['file']['name'] as $key => $name) {

				$_FILES['images[]']['name'] = $_FILES['file']['name'][$key];
				$_FILES['images[]']['type'] = $_FILES['file']['type'][$key];
				$_FILES['images[]']['tmp_name'] = $_FILES['file']['tmp_name'][$key];
				$_FILES['images[]']['error'] = $_FILES['file']['error'][$key];
				$_FILES['images[]']['size'] = $_FILES['file']['size'][$key];

				if ($this->upload->do_upload('images[]')) {

					$data['gallery_id'] = $id;
					$data['photo_name'] = $this->upload->data('file_name');

					// Add DB
					$this->db->insert('co_gallery', $data);

					if ($this->upload->data('image_width') > $this->max_width) {

						// Resize Picture
						$this->resize_img($this->upload->data('full_path'));
					}
				}
			}
		}

		/**
		 * Resize Image
		 *
		 * @param $path string
		 */
		private function resize_img($path)
		{
			_is_logged_in();

			// Resize Photo
			$configResize['image_library'] = 'gd2';
			$configResize['source_image'] = $path;
			$configResize['maintain_ratio'] = TRUE;
			$configResize['master_dim'] = 'auto';
			$configResize['width'] = $this->max_width;
			$configResize['height'] = $this->max_height;

			$this->image_lib->initialize($configResize);

			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}

			$this->image_lib->clear();
		}

		/**
		 * Delete Gallery Sections
		 *
		 */
		public function deletePhotos()
		{

			_is_logged_in();

			// Bulk Delete
			$getCount = count($_POST['DeleteData']);

			$i = 0;
			foreach ($_POST['DeleteData'] as $value) {
				$i = $i + 1;
				$this->co_gallery_model->delete_photo($value['id']);
			}

			if ($getCount == $i) {
				echo "redirect";
			}

		}

		/**
		 * Delete Single Photo
		 */
		public function deletePhotoSingle()
		{
			_is_logged_in();

			if ($_POST) {
				$this->co_gallery_model->delete_photo($this->input->post('id', true));
			}

		}


		/**
		 * Slider
		 *
		 * @param null $id
		 */
		public function slider($id = NULL)
		{

			_is_logged_in();

			//Title
			$pageData['pageTitle'] = 'Slider Ekle';

			// Custom Scripts
			$script_data['scripts'] = array(
				0 => 'plugins/blueimp/jquery.blueimp-gallery.min.js',
				1 => 'plugins/icheck/icheck.min.js',
				2 => 'plugins/validationengine/languages/jquery.validationEngine-tr.js',
				3 => 'plugins/validationengine/jquery.validationEngine.js',
				4 => 'plugins/bootstrap/bootstrap-select.js',
				5 => 'plugins/fileinput/fileinput.min.js',
				6 => 'plugins/dropzone/dropzone.min.js',
				7 => 'gallery.js'
			);

			// Get All Section Gallery
			$data['sliders'] = $this->co_gallery_model->getAllSliders();
			$data['current_lang'] = $this->session->userdata('language');

			if ($id !== NULL) {
				// Get By Id
				$data['sliderById'] = $this->co_gallery_model->getSliderById($id);
			}

			$this->load->view('partical/header', $pageData);
			$this->load->view('companents/co_gallery/slider/index', $data);
			$this->load->view('partical/footer', $script_data);

		}

		/**
		 * Add Slider Data to Database
		 */
		public function addSliderData()
		{
			_is_logged_in();

			$data = array();

			if ($_POST) {

				foreach ($this->input->post() as $key => $value) {
					$data[$key] = $value;
				}

				// Upload Photo
				$config['upload_path'] = './gallery/sliders/';
				$config['allowed_types'] = 'jpg|png';
				$config['max_size'] = $this->max_size;
				$config['encrypt_name'] = true;

				$this->upload->initialize($config);
				$this->upload->do_upload('section_photo');

				$data['section_photo'] = $this->upload->data('file_name');
			}

			// Send data
			$query = $this->co_gallery_model->add_Slider($data);

			if ($query > 0 && $this->upload->data('file_name')) {
				redirect('admin/co_gallery/slider?action=success');
			} else {
				redirect('admin/co_gallery/slider?action=error');
			}

		}

		/**
		 * Edit Slider
		 *
		 * @param $id int
		 */
		public function editSliderData($id)
		{
			_is_logged_in();

			$data = array();

			if ($_POST) {

				foreach ($this->input->post() as $key => $value) {
					$data[$key] = $value;
				}

				// Upload Photo
				$config['upload_path'] = './gallery/sliders/';
				$config['allowed_types'] = 'jpg|png';
				$config['max_size'] = $this->max_size;
				$config['encrypt_name'] = true;

				$this->upload->initialize($config);
				$this->upload->do_upload('section_photo');

				// Check Photo
				if ($this->upload->data('file_name')) {

					// Delete old file
					$this->db->where('id', $id);
					$q = $this->db->get('co_slider');
					$photo = $q->result_array();

					unlink($config['upload_path'] . $photo[0]['section_photo']);

					$data['section_photo'] = $this->upload->data('file_name');
				}
			}

			// Send data
			$query = $this->co_gallery_model->edit_slider($id, $data);

			if ($query > 0) {
				redirect('admin/co_gallery/slider?action=success');
			} else {
				redirect('admin/co_gallery/slider?action=error');
			}

		}

		/**
		 * Delete Slider Data
		 *
		 * @param $type string
		 */
		public function deleteSliderData($type = NULL)
		{

			_is_logged_in();

			if ($_POST && !$type) {

				$this->co_gallery_model->delete_slider($this->input->post('id', true));
				echo "ok";
			}

			// Bulk Delete
			if ($_POST && $type == 'bulk') {

				$getCount = count($_POST['DeleteData']);

				$i = 0;
				foreach ($_POST['DeleteData'] as $value) {

					$i = $i + 1;

					$this->co_gallery_model->delete_slider($value['id']);
					//echo "ok";
				}

				if ($getCount == $i) {
					echo "redirect";
				}
			}

		}

		/**
		 * Delete Single Slider
		 */
		public function deleteSliderSingle()
		{
			_is_logged_in();

			if ($_POST) {
				$this->co_gallery_model->delete_slider($this->input->post('id', true));
			}

		}


	}