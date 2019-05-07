<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Co_pages_model extends CI_Model
	{

		function __construct()
		{
			parent::__construct();
		}

		/**
		 * Get All Sections
		 *
		 * @return array
		 */
		public function getAllSections()
		{

			$dbs = $this->db->query("SELECT id, sub_category_id, section_name, modified, section_type 
									  FROM co_sections 
									  WHERE language = '" . $this->session->userdata('language') . "' 
									  ORDER BY sub_category_id, sorting ");

			if ($dbs->num_rows()) {

				foreach ($dbs->result_array() as $row) {

					$row['children'] = array();
					$vn = "row" . $row['id'];
					${$vn} = $row;

					if (!is_null($row['sub_category_id'])) {
						$vp = "parent" . $row['sub_category_id'];

						if (isset($data[$row['sub_category_id']])) {
							${$vp} = $data[$row['sub_category_id']];
						} else {

							${$vp} = array(
								'id'              => $row['sub_category_id'],
								'sub_category_id' => null,
								'children'        => array()
							);

							$data[$row['sub_category_id']] = &${$vp};
						}

						${$vp}['children'][] = &${$vn};
						$data[$row['sub_category_id']] = ${$vp};
					}

					$data[$row['id']] = &${$vn};
				}

				$result = array_filter($data, function ($elem) {
					return is_null($elem['sub_category_id']);
				});

				return $result;
			}
		}


		/**
		 * Get Section By id
		 *
		 * @param $id int
		 *
		 * @return array
		 */
		public function getSectionByid($id)
		{

			$this->db->where('id', $id);
			$q = $this->db->get('co_sections');

			return $q->row_array();
		}


		/**
		 * Add Section Data to Database
		 *
		 * @param $data array
		 *
		 * @return mixed int
		 */
		public function add_Section($data)
		{
			$this->db->insert('co_sections', $data);

			return $this->db->insert_id();
		}

		/**
		 * Update Section Data
		 *
		 * @param $id   int
		 * @param $data array
		 *
		 * @return mixed
		 */
		public function update_Section($id, $data)
		{
			$this->db->where('id', $id);
			$this->db->update('co_sections', $data);

			return $this->db->affected_rows();
		}


		/**
		 * Delete Section Data
		 *
		 * @param $id int
		 *
		 * @return mixed
		 */
		public function delete_section($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('co_sections');

			return $this->db->affected_rows();
		}

		/**
		 * Generate Pages Menu Items
		 *
		 * @return array
		 */
		public function generateTree()
		{

			$this->db->select('id, sub_category_id, section_name, modified, section_type, status, sorting');
			$this->db->from('co_sections');
			$this->db->where('language', $this->session->userdata('language'));
			$this->db->where('status', 1);
			$this->db->where('sub_category_id', 0);

			$parent = $this->db->get();

			$categories = $parent->result();

			$i = 0;
			foreach ($categories as $p_cat) {

				$categories[$i]->children = $this->sub_categories($p_cat->id);
				$i++;
			}

			return $categories;
		}

		/**
		 * Generate Pages Sub Categories
		 *
		 * @param $id int
		 *
		 * @return array
		 */
		public function sub_categories($id)
		{

			$this->db->select('id, sub_category_id, section_name, modified, section_type, status, sorting');
			$this->db->from('co_sections');
			$this->db->where('language', $this->session->userdata('language'));
			$this->db->where('status', 1);
			$this->db->where('sub_category_id', $id);

			$child = $this->db->get();
			$categories = $child->result();

			$i = 0;
			foreach ($categories as $p_cat) {

				$categories[$i]->children = $this->sub_categories($p_cat->id);
				$i++;
			}

			return $categories;
		}

		/**
		 * Get All Menu From DB for Sliding Menu
		 *
		 * @param $data array
		 *
		 * @return string
		 */
		public function fetch_menu_li($data)
		{

			$tpl = '';

			foreach ($data as $menu) {

				$tpl .= "<li>";
				$tpl .= "<a href=\"#\" sub-id=\"$menu->id\"><span class=\"fa fa-file-o\"></span>" . $menu->section_name . "</a>";

				if (!empty($menu->children)) {

					$tpl .= "<ul>";
					$tpl .= $this->fetch_sub_menu_li($menu->children);
					$tpl .= "</ul>";
				}

				$tpl .= "</li>";

			}

			return $tpl;
		}

		/**
		 * Get SubMenu Items for Sliding Menu
		 *
		 * @param $sub_menu
		 *
		 * @return string
		 */
		public function fetch_sub_menu_li($sub_menu)
		{

			$tpl = '';

			foreach ($sub_menu as $menu) {

				$tpl .= "<li><a href=\"javascript:void(0)\" sub-id=\"$menu->id\"><span class=\"fa fa-caret-right\"></span>" . $menu->section_name . "</a>";

				if (!empty($menu->children)) {

					$tpl .= "<ul>";
					$tpl .= $this->fetch_sub_menu_li($menu->children);
					$tpl .= "</ul>";
				}

				$tpl .= "</li>";
			}

			return $tpl;

		}

		/**
		 * Get All Menu From DB for Datatable
		 *
		 * @param $data array
		 *
		 * @return string
		 */
		public function fetch_menu_table($data)
		{

			$tpl = '';

			foreach ($data as $menu) {

				$tpl .= "<tr id=\"trow_$menu->id\">";
				$tpl .= "<td><strong>" . $menu->section_name . "</strong></td>";
				$tpl .= "<td>" . date('d.m.Y H:i', strtotime($menu->modified)) . "</td>";
				if ($menu->status == 1) {
					$tpl .= "<td><span class=\"label label-success\">Aktif</span></td>";
				} else {
					$tpl .= "<td><span class=\"label label-danger\">Deaktif</span></td>";
				}
				$tpl .= "<td>$menu->sorting</td>";
				$tpl .= "<td>
							<button class=\"btn btn-default btn-rounded btn-condensed btn-sm\">
                               <a href=\"/admin/co_pages/edit_section/$menu->id\"><span class=\"fa fa-pencil\"></span></a>
                             </button>
                             <a href=\"/admin/co_pages/delete/$menu->id\"
								class=\"btn btn-danger btn-rounded btn-condensed btn-sm\"
                                onclick=\"return confirm('Bu kaydı silmek istiyor musunuz?');\">
                                 <span class=\"fa fa-times\"></span>
                             </a>
                          </td>";

				if (!empty($menu->children)) {
					$tpl .= $this->fetch_sub_menu_table($menu->children, 1);
				}

				$tpl .= "</tr>";

			}

			return $tpl;
		}

		/**
		 * Get SubMenu Items for Datatable
		 *
		 * @param $sub_menu
		 * @param $line int
		 *
		 * @return string
		 */
		public function fetch_sub_menu_table($sub_menu, $line)
		{

			$tpl = '';
			$lineTmp = '';

			// Create line
			for ($i = 0; $i < $line; $i++) {
				$lineTmp .= '-';
			}

			foreach ($sub_menu as $menu) {

				$tpl .= "<tr id=\"trow_$menu->id\">";
				if ($menu->section_type == '1') {
					$section_edit_url = 'edit_content';

					$tpl .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;$lineTmp " . $menu->section_name . "</td>";
				} else {
					$section_edit_url = 'edit_section';

					$tpl .= "<td><strong>&nbsp; $lineTmp " . $menu->section_name . "</strong></td>";
				}

				$tpl .= "<td>" . date('d.m.Y H:i', strtotime($menu->modified)) . "</td>";

				if ($menu->status == 1) {
					$tpl .= "<td><span class=\"label label-success\">Aktif</span></td>";
				} else {
					$tpl .= "<td><span class=\"label label-danger\">Deaktif</span></td>";
				}
				$tpl .= "<td>$menu->sorting</td>";
				$tpl .= "<td>
							<button class=\"btn btn-default btn-rounded btn-condensed btn-sm\">
                               <a href=\"/admin/co_pages/$section_edit_url/$menu->id\"><span class=\"fa fa-pencil\"></span></a>
                             </button>
                             <a href=\"/admin/co_pages/delete/$menu->id\"
								class=\"btn btn-danger btn-rounded btn-condensed btn-sm\"
                                onclick=\"return confirm('Bu kaydı silmek istiyor musunuz?');\">
                                 <span class=\"fa fa-times\"></span>
                             </a>
                          </td>";

				if (!empty($menu->children)) {
					$line = $line + 1;
					$tpl .= $this->fetch_sub_menu_table($menu->children, $line);
				}

				$tpl .= "</tr>";
			}

			return $tpl;

		}

	}