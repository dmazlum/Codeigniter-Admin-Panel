<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Co_users_model extends CI_Model
	{

		function __construct()
		{
			parent::__construct();
		}

		/**
		 * Get All Site Users
		 *
		 * @return array
		 */
		public function get_all_users()
		{
			$this->db->order_by('role', 'ASC');

			return $this->db->get('co_users')->result_array();
		}

		/**
		 * Add Site User
		 *
		 * @param $params array
		 * @return mixed
		 */
		public function add_users($params)
		{
			$this->db->insert('co_users', $params);

			return $this->db->insert_id();
		}

		/**
		 * Get Site User By id
		 *
		 * @param $id int
		 * @return array
		 */
		function get_user($id)
		{
			return $this->db->get_where('co_users', array('id' => $id))->row_array();
		}

		/**
		 * Update Site User
		 *
		 * @param $id int
		 * @param $params
		 */
		function update_user($id, $params)
		{
			$this->db->where('id', $id);
			$this->db->update('co_users', $params);
		}

		/**
		 * Delete Site User
		 *
		 * @param $id int
		 */
		function delete_user($id)
		{
			$this->db->delete('co_users', array('id' => $id));
		}
	}