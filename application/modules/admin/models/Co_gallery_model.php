<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Co_gallery_model extends CI_Model
	{

		function __construct()
		{
			parent::__construct();
		}


		/**
		 * Get All Gallery Sections
		 *
		 * @return array
		 */
		public function getAllSectionGallery()
		{
			$this->db->where('language', $this->session->userdata('language'));
			$this->db->order_by('sorting', 'ASC');
			$q = $this->db->get('co_gallery_section');

			return $q->result_array();
		}

		/**
		 * Get All Gallery Sections Count
		 *
		 * @return array
		 */
		public function getAllSectionCount()
		{
			$data = array();

			$this->db->where('language', $this->session->userdata('language'));
			$this->db->order_by('sorting', 'ASC');
			$q = $this->db->get('co_gallery_section');

			foreach ($q->result_array() as $item) {

				$this->db->where('gallery_id', $item['id']);
				$q = $this->db->get('co_gallery');

				$item['count'] = $q->num_rows();
				$data[] = $item;
			}

			return $data;
		}

		/**
		 * Get Gallery By Id
		 *
		 * @param $id int
		 * @return array
		 */
		public function getById($id)
		{
			$this->db->where('id', $id);
			$q = $this->db->get('co_gallery_section');

			return $q->result_array();
		}

		/**
		 * Add Gallery Section Data to Database
		 *
		 * @param $data array
		 * @return mixed int
		 */
		public function add_Section($data)
		{
			$this->db->insert('co_gallery_section', $data);

			return $this->db->insert_id();
		}

		/**
		 * Update Gallery Section
		 *
		 * @param $id int
		 * @param $data array
		 * @return mixed
		 */
		public function edit_section($id, $data)
		{
			$this->db->where('id', $id);
			$this->db->update('co_gallery_section', $data);

			return $this->db->affected_rows();

		}

		/**
		 * Delete Gallery Section Data
		 *
		 * @param $id int
		 * @return mixed
		 */
		public function delete_section($id)
		{
			// delete old photo
			$this->db->where('id', $id);
			$q = $this->db->get('co_gallery_section');

			$result = $q->result_array();

			if ($result) {
				unlink('./gallery/sections/' . $result[0]['section_photo']);
			}

			$this->db->where('id', $id);
			$this->db->delete('co_gallery_section');

			return $this->db->affected_rows();
		}

		/**
		 * Delete Gallery Photos
		 *
		 * @param $id int
		 * @return mixed
		 */
		public function delete_photo($id)
		{
			//Delete photo from server
			$this->db->where('id', $id);
			$q = $this->db->get('co_gallery');

			$result = $q->result_array();

			if ($result) {
				unlink('./gallery/' . $result[0]['photo_name']);
			}

			// Delete from DB
			$this->db->where('id', $id);
			$this->db->delete('co_gallery');

			return $this->db->affected_rows();
		}

		/**
		 * Is There photo in the gallery section?
		 *
		 * @param $sectionId int
		 * @return int
		 */
		public function checkPhoto($sectionId)
		{
			if ($sectionId) {
				$this->db->where('gallery_id', $sectionId);
			}

			return $this->db->get('co_gallery')->num_rows();
		}


		/**
		 * Get All Photos By Id
		 *
		 * @param $id int
		 * @param $limit int
		 * @param $start int
		 * @return array
		 */
		public function getPhotosById($id, $limit, $start)
		{

			$this->db->where('gallery_id', $id);
			$this->db->limit($limit, $start);
			$q = $this->db->get('co_gallery');

			return $q->result_array();
		}

		/**
		 * Get All Sliders
		 *
		 * @return array
		 */
		public function getAllSliders()
		{
			$this->db->where('language', $this->session->userdata('language'));
			$this->db->order_by('sorting', 'ASC');
			$q = $this->db->get('co_slider');

			return $q->result_array();
		}

		/**
		 * Add Gallery Section Data to Database
		 *
		 * @param $data array
		 * @return mixed int
		 */
		public function add_Slider($data)
		{
			$this->db->insert('co_slider', $data);

			return $this->db->insert_id();
		}

		/**
		 * Update Slider
		 *
		 * @param $id int
		 * @param $data array
		 * @return mixed
		 */
		public function edit_slider($id, $data)
		{
			$this->db->where('id', $id);
			$this->db->update('co_slider', $data);

			return $this->db->affected_rows();

		}

		/**
		 * Get Slider By Id
		 *
		 * @param $id int
		 * @return array
		 */
		public function getSliderById($id)
		{
			$this->db->where('id', $id);
			$q = $this->db->get('co_slider');

			return $q->result_array();
		}

		/**
		 * Delete Slider Data
		 *
		 * @param $id int
		 * @return mixed
		 */
		public function delete_slider($id)
		{
			// delete old photo
			$this->db->where('id', $id);
			$q = $this->db->get('co_slider');

			$result = $q->result_array();

			if ($result) {
				unlink('./gallery/sliders/' . $result[0]['section_photo']);
			}

			$this->db->where('id', $id);
			$this->db->delete('co_slider');

			return $this->db->affected_rows();
		}

	}