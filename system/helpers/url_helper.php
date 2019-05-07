<?php
	/**
	 * CodeIgniter
	 *
	 * An open source application development framework for PHP
	 *
	 * This content is released under the MIT License (MIT)
	 *
	 * Copyright (c) 2014 - 2016, British Columbia Institute of Technology
	 *
	 * Permission is hereby granted, free of charge, to any person obtaining a copy
	 * of this software and associated documentation files (the "Software"), to deal
	 * in the Software without restriction, including without limitation the rights
	 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	 * copies of the Software, and to permit persons to whom the Software is
	 * furnished to do so, subject to the following conditions:
	 *
	 * The above copyright notice and this permission notice shall be included in
	 * all copies or substantial portions of the Software.
	 *
	 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	 * THE SOFTWARE.
	 *
	 * @package    CodeIgniter
	 * @author    EllisLab Dev Team
	 * @copyright    Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
	 * @copyright    Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
	 * @license    http://opensource.org/licenses/MIT	MIT License
	 * @link    https://codeigniter.com
	 * @since    Version 1.0.0
	 * @filesource
	 */
	defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	 * CodeIgniter URL Helpers
	 *
	 * @package        CodeIgniter
	 * @subpackage    Helpers
	 * @category    Helpers
	 * @author        EllisLab Dev Team
	 * @link        https://codeigniter.com/user_guide/helpers/url_helper.html
	 */

// ------------------------------------------------------------------------

	if (!function_exists('site_url')) {
		/**
		 * Site URL
		 *
		 * Create a local URL based on your basepath. Segments can be passed via the
		 * first parameter either as a string or an array.
		 *
		 * @param    string $uri
		 * @param    string $protocol
		 * @return    string
		 */
		function site_url($uri = '', $protocol = NULL)
		{
			return get_instance()->config->site_url($uri, $protocol);
		}
	}

// ------------------------------------------------------------------------

	if (!function_exists('base_url')) {
		/**
		 * Base URL
		 *
		 * Create a local URL based on your basepath.
		 * Segments can be passed in as a string or an array, same as site_url
		 * or a URL to a file can be passed in, e.g. to an image file.
		 *
		 * @param    string $uri
		 * @param    string $protocol
		 * @return    string
		 */
		function base_url($uri = '', $protocol = NULL)
		{
			return get_instance()->config->base_url($uri, $protocol);
		}
	}

// ------------------------------------------------------------------------

	if (!function_exists('current_url')) {
		/**
		 * Current URL
		 *
		 * Returns the full URL (including segments) of the page where this
		 * function is placed
		 *
		 * @return    string
		 */
		function current_url()
		{
			$CI =& get_instance();

			return $CI->config->site_url($CI->uri->uri_string());
		}
	}

// ------------------------------------------------------------------------

	if (!function_exists('uri_string')) {
		/**
		 * URL String
		 *
		 * Returns the URI segments.
		 *
		 * @return    string
		 */
		function uri_string()
		{
			return get_instance()->uri->uri_string();
		}
	}

// ------------------------------------------------------------------------

	if (!function_exists('index_page')) {
		/**
		 * Index page
		 *
		 * Returns the "index_page" from your config file
		 *
		 * @return    string
		 */
		function index_page()
		{
			return get_instance()->config->item('index_page');
		}
	}

// ------------------------------------------------------------------------

	if (!function_exists('anchor')) {
		/**
		 * Anchor Link
		 *
		 * Creates an anchor based on the local URL.
		 *
		 * @param    string    the URL
		 * @param    string    the link title
		 * @param    mixed    any attributes
		 * @return    string
		 */
		function anchor($uri = '', $title = '', $attributes = '')
		{
			$title = (string)$title;

			$site_url = is_array($uri)
				? site_url($uri)
				: (preg_match('#^(\w+:)?//#i', $uri) ? $uri : site_url($uri));

			if ($title === '') {
				$title = $site_url;
			}

			if ($attributes !== '') {
				$attributes = _stringify_attributes($attributes);
			}

			return '<a href="' . $site_url . '"' . $attributes . '>' . $title . '</a>';
		}
	}

// ------------------------------------------------------------------------

	if (!function_exists('anchor_popup')) {
		/**
		 * Anchor Link - Pop-up version
		 *
		 * Creates an anchor based on the local URL. The link
		 * opens a new window based on the attributes specified.
		 *
		 * @param    string    the URL
		 * @param    string    the link title
		 * @param    mixed    any attributes
		 * @return    string
		 */
		function anchor_popup($uri = '', $title = '', $attributes = FALSE)
		{
			$title = (string)$title;
			$site_url = preg_match('#^(\w+:)?//#i', $uri) ? $uri : site_url($uri);

			if ($title === '') {
				$title = $site_url;
			}

			if ($attributes === FALSE) {
				return '<a href="' . $site_url . '" onclick="window.open(\'' . $site_url . "', '_blank'); return false;\">" . $title . '</a>';
			}

			if (!is_array($attributes)) {
				$attributes = array($attributes);

				// Ref: http://www.w3schools.com/jsref/met_win_open.asp
				$window_name = '_blank';
			} elseif (!empty($attributes['window_name'])) {
				$window_name = $attributes['window_name'];
				unset($attributes['window_name']);
			} else {
				$window_name = '_blank';
			}

			foreach (array('width' => '800', 'height' => '600', 'scrollbars' => 'yes', 'menubar' => 'no', 'status' => 'yes', 'resizable' => 'yes', 'screenx' => '0', 'screeny' => '0') as $key => $val) {
				$atts[$key] = isset($attributes[$key]) ? $attributes[$key] : $val;
				unset($attributes[$key]);
			}

			$attributes = _stringify_attributes($attributes);

			return '<a href="' . $site_url
			. '" onclick="window.open(\'' . $site_url . "', '" . $window_name . "', '" . _stringify_attributes($atts, TRUE) . "'); return false;\""
			. $attributes . '>' . $title . '</a>';
		}
	}

// ------------------------------------------------------------------------

	if (!function_exists('mailto')) {
		/**
		 * Mailto Link
		 *
		 * @param    string    the email address
		 * @param    string    the link title
		 * @param    mixed    any attributes
		 * @return    string
		 */
		function mailto($email, $title = '', $attributes = '')
		{
			$title = (string)$title;

			if ($title === '') {
				$title = $email;
			}

			return '<a href="mailto:' . $email . '"' . _stringify_attributes($attributes) . '>' . $title . '</a>';
		}
	}

// ------------------------------------------------------------------------

	if (!function_exists('safe_mailto')) {
		/**
		 * Encoded Mailto Link
		 *
		 * Create a spam-protected mailto link written in Javascript
		 *
		 * @param    string    the email address
		 * @param    string    the link title
		 * @param    mixed    any attributes
		 * @return    string
		 */
		function safe_mailto($email, $title = '', $attributes = '')
		{
			$title = (string)$title;

			if ($title === '') {
				$title = $email;
			}

			$x = str_split('<a href="mailto:', 1);

			for ($i = 0, $l = strlen($email); $i < $l; $i++) {
				$x[] = '|' . ord($email[$i]);
			}

			$x[] = '"';

			if ($attributes !== '') {
				if (is_array($attributes)) {
					foreach ($attributes as $key => $val) {
						$x[] = ' ' . $key . '="';
						for ($i = 0, $l = strlen($val); $i < $l; $i++) {
							$x[] = '|' . ord($val[$i]);
						}
						$x[] = '"';
					}
				} else {
					for ($i = 0, $l = strlen($attributes); $i < $l; $i++) {
						$x[] = $attributes[$i];
					}
				}
			}

			$x[] = '>';

			$temp = array();
			for ($i = 0, $l = strlen($title); $i < $l; $i++) {
				$ordinal = ord($title[$i]);

				if ($ordinal < 128) {
					$x[] = '|' . $ordinal;
				} else {
					if (count($temp) === 0) {
						$count = ($ordinal < 224) ? 2 : 3;
					}

					$temp[] = $ordinal;
					if (count($temp) === $count) {
						$number = ($count === 3)
							? (($temp[0] % 16) * 4096) + (($temp[1] % 64) * 64) + ($temp[2] % 64)
							: (($temp[0] % 32) * 64) + ($temp[1] % 64);
						$x[] = '|' . $number;
						$count = 1;
						$temp = array();
					}
				}
			}

			$x[] = '<';
			$x[] = '/';
			$x[] = 'a';
			$x[] = '>';

			$x = array_reverse($x);

			$output = "<script type=\"text/javascript\">\n"
				. "\t//<![CDATA[\n"
				. "\tvar l=new Array();\n";

			for ($i = 0, $c = count($x); $i < $c; $i++) {
				$output .= "\tl[" . $i . "] = '" . $x[$i] . "';\n";
			}

			$output .= "\n\tfor (var i = l.length-1; i >= 0; i=i-1) {\n"
				. "\t\tif (l[i].substring(0, 1) === '|') document.write(\"&#\"+unescape(l[i].substring(1))+\";\");\n"
				. "\t\telse document.write(unescape(l[i]));\n"
				. "\t}\n"
				. "\t//]]>\n"
				. '</script>';

			return $output;
		}
	}

// ------------------------------------------------------------------------

	if (!function_exists('auto_link')) {
		/**
		 * Auto-linker
		 *
		 * Automatically links URL and Email addresses.
		 * Note: There's a bit of extra code here to deal with
		 * URLs or emails that end in a period. We'll strip these
		 * off and add them after the link.
		 *
		 * @param    string    the string
		 * @param    string    the type: email, url, or both
		 * @param    bool    whether to create pop-up links
		 * @return    string
		 */
		function auto_link($str, $type = 'both', $popup = FALSE)
		{
			// Find and replace any URLs.
			if ($type !== 'email' && preg_match_all('#(\w*://|www\.)[^\s()<>;]+\w#i', $str, $matches, PREG_OFFSET_CAPTURE | PREG_SET_ORDER)) {
				// Set our target HTML if using popup links.
				$target = ($popup) ? ' target="_blank"' : '';

				// We process the links in reverse order (last -> first) so that
				// the returned string offsets from preg_match_all() are not
				// moved as we add more HTML.
				foreach (array_reverse($matches) as $match) {
					// $match[0] is the matched string/link
					// $match[1] is either a protocol prefix or 'www.'
					//
					// With PREG_OFFSET_CAPTURE, both of the above is an array,
					// where the actual value is held in [0] and its offset at the [1] index.
					$a = '<a href="' . (strpos($match[1][0], '/') ? '' : 'http://') . $match[0][0] . '"' . $target . '>' . $match[0][0] . '</a>';
					$str = substr_replace($str, $a, $match[0][1], strlen($match[0][0]));
				}
			}

			// Find and replace any emails.
			if ($type !== 'url' && preg_match_all('#([\w\.\-\+]+@[a-z0-9\-]+\.[a-z0-9\-\.]+[^[:punct:]\s])#i', $str, $matches, PREG_OFFSET_CAPTURE)) {
				foreach (array_reverse($matches[0]) as $match) {
					if (filter_var($match[0], FILTER_VALIDATE_EMAIL) !== FALSE) {
						$str = substr_replace($str, safe_mailto($match[0]), $match[1], strlen($match[0]));
					}
				}
			}

			return $str;
		}
	}

// ------------------------------------------------------------------------

	if (!function_exists('prep_url')) {
		/**
		 * Prep URL
		 *
		 * Simply adds the http:// part if no scheme is included
		 *
		 * @param    string    the URL
		 * @return    string
		 */
		function prep_url($str = '')
		{
			if ($str === 'http://' OR $str === '') {
				return '';
			}

			$url = parse_url($str);

			if (!$url OR !isset($url['scheme'])) {
				return 'http://' . $str;
			}

			return $str;
		}
	}

// ------------------------------------------------------------------------

	if (!function_exists('url_title')) {
		/**
		 * Create URL Title
		 *
		 * Takes a "title" string as input and creates a
		 * human-friendly URL string with a "separator" string
		 * as the word separator.
		 *
		 * @todo    Remove old 'dash' and 'underscore' usage in 3.1+.
		 * @param    string $str Input string
		 * @param           $options array
		 * @return    string
		 */
		function url_title($str, $options = array())
		{
			// Make sure string is in UTF-8 and strip invalid UTF-8 characters
			$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());

			$defaults = array(
				'delimiter'     => '-',
				'limit'         => null,
				'lowercase'     => true,
				'replacements'  => array(),
				'transliterate' => true,
			);

			// Merge options
			$options = array_merge($defaults, $options);

			$char_map = array(
				// Latin
				'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
				'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
				'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
				'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
				'ß' => 'ss',
				'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
				'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
				'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
				'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
				'ÿ' => 'y',
				// Latin symbols
				'©' => '(c)',
				// Greek
				'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
				'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
				'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
				'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
				'Ϋ' => 'Y',
				'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
				'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
				'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
				'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
				'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
				// Turkish
				'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
				'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
				// Russian
				'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
				'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
				'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
				'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
				'Я' => 'Ya',
				'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
				'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
				'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
				'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
				'я' => 'ya',
				// Ukrainian
				'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
				'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
				// Czech
				'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
				'Ž' => 'Z',
				'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
				'ž' => 'z',
				// Polish
				'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
				'Ż' => 'Z',
				'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
				'ż' => 'z',
				// Latvian
				'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
				'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
				'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
				'š' => 's', 'ū' => 'u', 'ž' => 'z'
			);

			// Make custom replacements
			$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

			// Transliterate characters to ASCII
			if ($options['transliterate']) {
				$str = str_replace(array_keys($char_map), $char_map, $str);
			}

			// Replace non-alphanumeric characters with our delimiter
			$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

			// Remove duplicate delimiters
			$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

			// Truncate slug to max. characters
			$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');

			// Remove delimiter from ends
			$str = trim($str, $options['delimiter']);

			return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
		}
	}

// ------------------------------------------------------------------------

	if (!function_exists('redirect')) {
		/**
		 * Header Redirect
		 *
		 * Header redirect in two flavors
		 * For very fine grained control over headers, you could use the Output
		 * Library's set_header() function.
		 *
		 * @param    string $uri URL
		 * @param    string $method Redirect method
		 *            'auto', 'location' or 'refresh'
		 * @param    int    $code HTTP Response status code
		 * @return    void
		 */
		function redirect($uri = '', $method = 'auto', $code = NULL)
		{
			if (!preg_match('#^(\w+:)?//#i', $uri)) {
				$uri = site_url($uri);
			}

			// IIS environment likely? Use 'refresh' for better compatibility
			if ($method === 'auto' && isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS') !== FALSE) {
				$method = 'refresh';
			} elseif ($method !== 'refresh' && (empty($code) OR !is_numeric($code))) {
				if (isset($_SERVER['SERVER_PROTOCOL'], $_SERVER['REQUEST_METHOD']) && $_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1') {
					$code = ($_SERVER['REQUEST_METHOD'] !== 'GET')
						? 303    // reference: http://en.wikipedia.org/wiki/Post/Redirect/Get
						: 307;
				} else {
					$code = 302;
				}
			}

			switch ($method) {
				case 'refresh':
					header('Refresh:0;url=' . $uri);
					break;
				default:
					header('Location: ' . $uri, TRUE, $code);
					break;
			}
			exit;
		}
	}
