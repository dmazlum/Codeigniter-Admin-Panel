<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Co_news_model extends CI_Model
	{

		function __construct()
		{
			parent::__construct();
		}

		/**
		 * get All News Content
		 *
		 * @return array
		 */
		public function getAllContent()
		{

			$this->db->where('language', $this->session->userdata('language'));
			$this->db->order_by('id', 'DESC');
			$q = $this->db->get('co_news');

			return $q->result_array();
		}

		/**
		 * Get News Content By Id
		 *
		 * @param $id int
		 * @return array
		 */
		public function getContentById($id)
		{
			$this->db->where('id', $id);
			$q = $this->db->get('co_news');

			return $q->result_array();
		}

		/**
		 * Add News Content Data to Database
		 *
		 * @param $data array
		 * @return mixed int
		 */
		public function add_content($data)
		{
			$this->db->insert('co_news', $data);

			return $this->db->insert_id();
		}

		/**
		 * Update News Content Data
		 *
		 * @param $id int
		 * @param $data array
		 * @return int
		 */
		public function update_content($id, $data)
		{
			$this->db->where('id', $id);
			$this->db->update('co_news', $data);

			return $this->db->affected_rows();
		}


		/**
		 * Delete News Content Data
		 *
		 * @param $id int
		 * @return mixed
		 */
		public function delete_content($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('co_news');

			return $this->db->affected_rows();
		}
	}