<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Co_news extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();

			$this->load->model('co_news_model');
			$this->load->library('upload');
			$this->load->library('image_lib');
			$this->load->helper('text');
		}

		private $max_width = 1280;
		private $max_height = 720;
		private $max_size = 2048;

		/**
		 * Add News Content
		 */
		public function content()
		{
			_is_logged_in();

			//Title
			$pageData['pageTitle'] = 'Duyuru Ekle';

			// Custom Scripts
			$script_data['scripts'] = array(
				0 => 'plugins/bootstrap/bootstrap-select.js',
				1 => 'plugins/validationengine/languages/jquery.validationEngine-tr.js',
				2 => 'plugins/validationengine/jquery.validationEngine.js',
				3 => 'plugins/summernote/summernote.js',
				4 => 'plugins/fileinput/fileinput.min.js',
				5 => 'plugins/dropzone/dropzone.min.js',
				6 => 'gallery.js'
			);

			$data['all_content'] = $this->co_news_model->getAllContent();
			$data['current_lang'] = $this->session->userdata('language');

			$this->load->view('partical/header', $pageData);
			$this->load->view('companents/co_news/content/add', $data);
			$this->load->view('partical/footer', $script_data);
		}

		/**
		 * Add News Content Data to DB
		 */
		public function addContentData()
		{
			_is_logged_in();

			$data = array();
			$dbImageFormat = '';

			if ($_POST) {

				foreach ($this->input->post() as $key => $value) {

					if ($key == 'news_subject') {
						$data['news_slug'] = url_title(convert_accented_characters($value));
					}
					$data[$key] = $value;
				}
			}

			if (!empty($_FILES['news_photo']['name'][0])) {

				// Upload Photo
				$configUpload['upload_path'] = './gallery/news/';
				$configUpload['allowed_types'] = 'jpg|png';
				$configUpload['max_size'] = $this->max_size;
				$configUpload['encrypt_name'] = true;

				$this->upload->initialize($configUpload);


				foreach ($_FILES['news_photo']['name'] as $key => $name) {

					$_FILES['images[]']['name'] = $_FILES['news_photo']['name'][$key];
					$_FILES['images[]']['type'] = $_FILES['news_photo']['type'][$key];
					$_FILES['images[]']['tmp_name'] = $_FILES['news_photo']['tmp_name'][$key];
					$_FILES['images[]']['error'] = $_FILES['news_photo']['error'][$key];
					$_FILES['images[]']['size'] = $_FILES['news_photo']['size'][$key];

					if ($this->upload->do_upload('images[]')) {

						$dbImageFormat .= $this->upload->data('file_name') . ",";

						if ($this->upload->data('image_width') <= $this->max_width) {

							// Resize Picture
							$this->resize_img($this->upload->data('full_path'));
						}
					}
				}

				$data['news_photo'] = rtrim($dbImageFormat, ',');
			}

			// Send data
			$query = $this->co_news_model->add_content($data);

			if ($query > 0) {
				redirect('admin/co_news/content?action=success');
			} else {
				redirect('admin/co_news/content?action=error');
			}
		}

		/**
		 * Edit News Content
		 *
		 * @param $id int
		 */
		public function edit_content($id)
		{
			_is_logged_in();

			//Title
			$pageData['pageTitle'] = 'Duyuru Güncelle';

			// Custom Scripts
			$script_data['scripts'] = array(
				0 => 'plugins/bootstrap/bootstrap-select.js',
				1 => 'plugins/validationengine/languages/jquery.validationEngine-tr.js',
				2 => 'plugins/validationengine/jquery.validationEngine.js',
				3 => 'plugins/summernote/summernote.js',
				4 => 'plugins/fileinput/fileinput.min.js',
				5 => 'plugins/dropzone/dropzone.min.js',
				6 => 'plugins/blueimp/jquery.blueimp-gallery.min.js',
				7 => 'gallery.js'
			);

			$data['all_content'] = $this->co_news_model->getAllContent();
			$data['content_news'] = $this->co_news_model->getContentById($id);
			$data['current_lang'] = $this->session->userdata('language');

			//Register Session for delete image
			$sess = array(
				'newsPhotoId' => $id
			);
			$this->session->set_userdata($sess);

			$this->load->view('partical/header', $pageData);
			$this->load->view('companents/co_news/content/edit', $data);
			$this->load->view('partical/footer', $script_data);
		}

		/**
		 * Delete News Photos
		 *
		 * @param $sectionId int
		 */
		public function deleteNewsPhoto($sectionId)
		{
			$photoId = $this->session->userdata('newsPhotoId');
			$q = $this->db->get_where('news', array('id' => $photoId))->result_array();

			//echo "<pre>" . print_r($q);

			if ($q) {

				$data = array();

				$currentPhotos = explode(',', $q[0]['news_photo']);
				unset($currentPhotos[$sectionId]);
				unlink('./gallery/news/' . $currentPhotos[$sectionId]);

				$data['news_photo'] = implode(',', $currentPhotos);

				//Update Photos
				$this->db->where('id', $photoId);
				$this->db->update('news', $data);
			}
		}

		/** News Edit Content Data
		 *
		 * @param $id int
		 */
		public function editContentData($id)
		{
			_is_logged_in();

			$data = array();
			$dbImageFormat = '';

			if ($_POST) {

				foreach ($this->input->post() as $key => $value) {

					if ($key == 'news_subject') {
						$data['news_slug'] = url_title(convert_accented_characters($value));
					}
					$data[$key] = $value;
				}
			}

			if (!empty($_FILES['news_photo']['name'][0])) {

				// Upload Photo
				$configUpload['upload_path'] = './gallery/news/';
				$configUpload['allowed_types'] = 'jpg|png';
				$configUpload['max_size'] = $this->max_size;
				$configUpload['encrypt_name'] = true;

				$this->upload->initialize($configUpload);

				foreach ($_FILES['news_photo']['name'] as $key => $name) {

					$_FILES['images[]']['name'] = $_FILES['news_photo']['name'][$key];
					$_FILES['images[]']['type'] = $_FILES['news_photo']['type'][$key];
					$_FILES['images[]']['tmp_name'] = $_FILES['news_photo']['tmp_name'][$key];
					$_FILES['images[]']['error'] = $_FILES['news_photo']['error'][$key];
					$_FILES['images[]']['size'] = $_FILES['news_photo']['size'][$key];

					if ($this->upload->do_upload('images[]')) {

						$dbImageFormat .= $this->upload->data('file_name') . ",";

						if ($this->upload->data('image_width') <= $this->max_width) {

							// Resize Picture
							$this->resize_img($this->upload->data('full_path'));
						}
					}
				}

				$data['news_photo'] = rtrim($dbImageFormat, ',');
			}

			// Send data
			$query = $this->co_news_model->update_content($id, $data);

			if ($query > 0) {
				redirect('admin/co_news/content?action=success');
			} else {
				redirect('admin/co_news/content?action=error');
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

			$q = $this->co_news_model->delete_content($id);

			if ($q) {
				redirect('admin/co_news/content?action=success');
			} else {
				redirect('admin/co_news/content?action=error');
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
			$configResize['maintain_ratio'] = true;
			$configResize['master_dim'] = 'auto';
			$configResize['width'] = $this->max_width;
			$configResize['height'] = $this->max_height;

			$this->image_lib->initialize($configResize);

			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}

			$this->image_lib->clear();
		}

	}