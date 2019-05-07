<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class ErrorHandler extends CI_Controller
	{

		/**
		 * 404 Custom Error Page
		 */
		public function page_missing()
		{
			_is_logged_in();

			$this->load->view('partical/header');
			$this->load->view('404error');
			$this->load->view('partical/footer');
		}
	}