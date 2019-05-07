<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Login extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Login_model');
			$this->load->helper('MY_Mailler');
		}

		/**
		 * Login Check to Admin
		 */
		public function doLogin()
		{
			if ($this->input->post('username') && $this->input->post('password')) {

				$params = array(
					'username' => $this->input->post('username'),
					'password' => md5(sha1($this->input->post('password')))
				);

				// Check DB
				$user = $this->Login_model->getLogin($params);

				if ($user) {

					if ($user['role'] == 'admin') {

						$newdata = array(
							'is_admin'  => TRUE,
							'logged_in' => TRUE,
							'language'  => 'tr'
						);

						// Admin Session Register
						$this->session->set_userdata($newdata);

						// First time Admin Password Checker
						// e: If your username:admin pass: admin
						// Redirect to change password page

						if ($params['username'] == 'admin' && $this->input->post('password') == 'admin') {

							$check_pass = $this->Login_model->getLogin($params);
							redirect(base_url() . 'admin/user/show/' . $check_pass['id'] . '?login=first_time');

						} else {
							redirect(base_url() . 'admin/dashboard');
						}

					} else {

						$newdata = array(
							'is_user'   => TRUE,
							'logged_in' => TRUE,
							'language'  => 'tr'
						);

						// User Session Register
						$this->session->set_userdata($newdata);

						redirect(base_url() . 'admin/dashboard');
					}
				} else {
					redirect(base_url() . 'admin/?login=incorrect');
				}

			} else {
				redirect(base_url() . 'admin/?login=false');
			}
		}

		/**
		 * Forgot Password
		 */
		public function forgot()
		{

			if ($_POST) {

				//Check Username and Reg Code
				$user_query = $this->Login_model->check_username($this->input->post('username', true));

				if ($user_query) {

					//Check Reg Code
					$reg_code = $this->Login_model->check_regcode($this->input->post('reg_code', true));

					if ($reg_code) {

						// create uniq password
						$un_id = uniqid();

						// Send E-Mail
						$message = "<h3>Sayın " . $user_query[0]['name_surname'] . ",</h3><br>";
						$message .= "<p>Admin Panel sisteminde kullanacağınız yeni şifreniz aşağıdaki gibidir.</p>";
						$message .= "<p>Yeni Şifreniz : <strong>" . $un_id . "</strong></p><br>";
						$message .= "<p>Şifrenizi istediğiniz zaman değiştirebilir veya mevcut şifreyi kullanabilirsiniz.</p><br>";
						$message .= "--------------------------------------------------------------------------------------------------";
						$message .= "<p>Bu mesaj " . base_url() . " sitesinden, " . date('d.m.Y H:i') . " tarihinde gönderilmiştir.</p>";

						sendmail(NULL, 'Admin Panel', $user_query[0]['email_address'], 'Şifre Sıfrlama İsteği', $message);

						// Change old password with new password
						$this->db->where('username', $user_query[0]['username']);
						$this->db->update('users', array('password' => md5(sha1($un_id))));

						// Redirect
						redirect(base_url() . 'admin/forgot_password?action=senduser');

					} else {
						redirect(base_url() . 'admin/forgot_password?action=notfound');
					}
				} else {
					redirect(base_url() . 'admin/forgot_password?action=notfound');
				}

			}
		}

		/**
		 * Logout
		 */
		public function logout()
		{
			$this->session->sess_destroy();
			redirect(base_url() . 'admin');
		}

	}