<?php
	defined('BASEPATH') OR exit('No direct script access allowed.');

	$CI =& get_instance();
	$CI->load->database();

	// Get Email Config From Db
	$CI->db->select('config_value');
	$CI->db->where('config_name', 'mail_server');
	$CI->db->or_where('config_name', 'mail_port');
	$CI->db->or_where('config_name', 'mail_username');
	$CI->db->or_where('config_name', 'mail_password');
	$result = $CI->db->get('site_config')->result_array();

	$config['protocol'] = 'smtp';                   // 'mail', 'sendmail', or 'smtp'
	//$config['mailpath'] = '/usr/sbin/sendmail';
	$config['smtp_host'] = $result[0]['config_value'];
	$config['smtp_user'] = $result[1]['config_value'];
	$config['smtp_pass'] = $result[2]['config_value'];
	$config['smtp_port'] = $result[3]['config_value'];
	$config['smtp_timeout'] = 30;                       // (in seconds)
	$config['smtp_crypto'] = '';                       // '' or 'tls' or 'ssl'
	$config['smtp_debug'] = 0;                        // PHPMailer's SMTP debug info level: 0 = off, 1 = commands, 2 = commands and data, 3 = as 2 plus connection status, 4 = low level data output.
	$config['smtp_auto_tls'] = false;                     // Whether to enable TLS encryption automatically if a server supports it, even if `smtp_crypto` is not set to 'tls'.
	$config['smtp_conn_options'] = array();                 // SMTP connection options, an array passed to the function stream_context_create() when connecting via SMTP.
	$config['wordwrap'] = true;
	$config['wrapchars'] = 76;
	$config['mailtype'] = 'html';                   // 'text' or 'html'
	$config['charset'] = 'UTF-8';                     // 'UTF-8', 'ISO-8859-15', ...; NULL (preferable) means config_item('charset'), i.e. the character set of the site.
	$config['validate'] = false;
	$config['priority'] = 3;                        // 1, 2, 3, 4, 5; on PHPMailer useragent NULL is a possible option, it means that X-priority header is not set at all, see https://github.com/PHPMailer/PHPMailer/issues/449
	$config['crlf'] = "\n";                     // "\r\n" or "\n" or "\r"
	$config['newline'] = "\r\n";                     // "\r\n" or "\n" or "\r"
	$config['bcc_batch_mode'] = false;
	$config['bcc_batch_size'] = 200;
	$config['encoding'] = '8bit';                   // The body encoding. For CodeIgniter: '8bit' or '7bit'. For PHPMailer: '8bit', '7bit', 'binary', 'base64', or 'quoted-printable'.