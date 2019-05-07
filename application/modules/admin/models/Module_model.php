<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Module_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}

		/*
		 * get a module by id
		 */
		function get_module($table, $id)
		{
			return $this->db->get_where($table, array('id' => $id))->row_array();
		}

		/*
		 * get a module by fields
		 */
		function get_module_field($table, $params)
		{
			$this->db->order_by('module_id', 'ASC');
			return $this->db->get_where($table, $params)->result_array();
		}

		/*
		 * get all modules
		 */
		function get_all_modules($table, $field = NULL, $ordering = NULL)
		{
			if ($field) {
				$this->db->order_by($field, $ordering);
			}

			return $this->db->get($table)->result_array();
		}

		/*
		 * function to add new module
		 */
		function add_module($table, $params)
		{
			$this->db->insert($table, $params);

			return $this->db->insert_id();
		}

		/*
		 * function to update module
		 */
		function update_module($id, $table, $params)
		{
			$this->db->where('id', $id);
			$this->db->update($table, $params);
		}

		/*
		 * function to delete module
		 */
		function delete_module($table, $id)
		{
			$this->db->delete($table, array('id' => $id));
		}
	}
