<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	if (!function_exists('sendmail')) {

		/**
		 * Global SendMail Function
		 *
		 * @param null $sender If you send null it get default email address from db
		 * @param      $senderName string
		 * @param      $to string
		 * @param      $subject string
		 * @param      $message string HTML format
		 */
		function sendmail($sender = NULL, $senderName, $to, $subject, $message)
		{
			$CI =& get_instance();
			$CI->load->library('email');

			// Set Sender Address Default Site E-mail Address
			if (is_null($sender)) {
				$q = $CI->db->get_where('site_config', array('config_name' => 'site_email'))->result_array();
			}

			// Config
			$CI->email->from($q[0]['config_value'], $senderName);
			$CI->email->to($to);
			$CI->email->subject($subject);
			$CI->email->message($message);

			if (!$CI->email->send()) {

				// Generate error
				$CI->email->print_debugger();
			}
		}
	}