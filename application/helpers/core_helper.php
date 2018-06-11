<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (function_exists('clean') == FALSE) {

	function clean($input) {

		$output = trim(xss_clean(empty($input) ? NULL : $input));

		return $output;
	}
}

if (function_exists('fanum') == FALSE) {

	function fanum($input, $reverse = NULL) {

		$english = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
		$farsi   = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

		if ($reverse) {

			$output = str_replace($farsi, $english, (string) $input);

		} else {

			$output = str_replace($english, $farsi, (string) $input);
		}

		return $output;
	}
}

if (function_exists('uc_first') == FALSE) {

	function uc_first($input) {

		$output = ucfirst(strtolower((string) $input));

		return $output;
	}
}

if (function_exists('uc_words') == FALSE) {

	function uc_words($input)
	{
		$output = ucwords(strtolower((string) $input));

		return $output;
	}
}


if (function_exists('clear_url') == FALSE) {

	function clear_url($url)
	{
		$output = trim($url, '/');

		if (preg_match('#^http(s)?://#', $output) == FALSE) {

			$output = 'http://' . $output;
		}

		$output = parse_url($output);
		$output = preg_replace('/^www\./', '', $output['host']);

		return $output;
	}
}

if (function_exists('addhttp') == FALSE) {

	function addhttp($input)
	{
		if (empty($input) == FALSE && preg_match('~^(?:f|ht)tps?://~i', $input) == FALSE) {

			$input = 'http://' . $input;
		}

		return $input;
	}
}

if (function_exists('eol') == FALSE) {

	function eol($input = 1)
	{
		return str_repeat(PHP_EOL, $input);
	}
}

if (function_exists('gregorian') == FALSE) {

	function gregorian($input)
	{
		$input = explode('/', $input);

		$gregorian_days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		$shamsi_days    = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);

		$shamsi_year  = $input[0] - 979;
		$shamsi_month = $input[1] - 1;
		$shamsi_day   = $input[2] - 1;

		$calc_a = (int) ($shamsi_year / 33) * 8;
		$calc_b = (int) ($shamsi_year % 33 + 3) / 4;

		$shamsi = 365 * $shamsi_year + $calc_a + $calc_b;

		for ($increment = 0; $increment < $shamsi_month; ++$increment) {

			$shamsi = $shamsi + $shamsi_days[$increment];
		}

		$shamsi    = $shamsi + $shamsi_day;
		$gregorian = $shamsi + 79;

		$year      = 1600 + 400 * (int) ($shamsi / 146097);
		$gregorian = $gregorian % 146097;

		$leap = TRUE;

		if ($gregorian >= 36525) {

			$gregorian--;

			$year      = $year + 100 * (int) ($gregorian / 36524);
			$gregorian = $gregorian % 36524;

			if ($gregorian >= 365) {

				$gregorian++;

			} else {

				$leap = FALSE;
			}
		}

		$year      = $year + 4 * (int) ($gregorian / 1461);
		$gregorian = $gregorian % 1461;

		if ($gregorian >= 366) {

			$leap = FALSE;

			$gregorian--;

			$year      = $year + (int) ($gregorian / 365);
			$gregorian = $gregorian % 365;
		}

		for ($increment = 0; $gregorian >= $gregorian_days[$increment] + ($increment == 1 && $leap); $increment++) {

			$gregorian = $gregorian - $gregorian_days[$increment] + ($increment == 1 && $leap);
		}

		$month = str_pad($increment + 1, 2, 0, STR_PAD_LEFT);
		$day   = str_pad($gregorian + 1, 2, 0, STR_PAD_LEFT);

		$output = $year . '/' . $month . '/' . $day;

		return $output;
	}
}

if (function_exists('shamsi') == FALSE) {

	function shamsi($input)
	{
		$stamp = strtotime($input);

		$gregorian_days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		$shamsi_days    = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);

		$gregorian_year  = date('Y', $stamp) - 1600;
		$gregorian_month = date('m', $stamp) - 1;
		$gregorian_day   = date('d', $stamp) - 1;
		$default_time    = date('H:i', $stamp);

		$calc_a = (int) (365 * $gregorian_year);
		$calc_b = (int) (($gregorian_year + 3) / 4);
		$calc_c = (int) (($gregorian_year + 99) / 100);
		$calc_d = (int) (($gregorian_year + 399) / 400);

		$gregorian = $calc_a + $calc_b - $calc_c + $calc_d;

		for ($increment = 0; $increment < $gregorian_month; ++$increment) {

			$gregorian = $gregorian + $gregorian_days[$increment];
		}

		if ($gregorian_month > 1 && (($gregorian_year % 4 == 0 && $gregorian_year % 100 != 0) || ($gregorian_year % 400 == 0))) {

			$gregorian++;
		}

		$gregorian = $gregorian + $gregorian_day;
		$shamsi    = (int) ($gregorian - 79);
		$parse     = (int) ($shamsi / 12053);
		$shamsi    = (int) ($shamsi % 12053);
		$year      = (int) ((int) (33 * $parse) + (int) (4 * (int) ($shamsi / 1461)) + 979);
		$shamsi    = $shamsi % 1461;

		if ($shamsi >= 366) {

			$year   = $year + (int) (($shamsi - 1) / 365);
			$shamsi = (int) (($shamsi - 1) % 365);
		}

		for ($increment = 0; $increment < 11 && $shamsi >= $shamsi_days[$increment]; ++$increment) {

			$shamsi = $shamsi - $shamsi_days[$increment];
		}

		$month = str_pad($increment + 1, 2, 0, STR_PAD_LEFT);
		$day   = str_pad($shamsi + 1, 2, 0, STR_PAD_LEFT);

		$output = $year . '/' . $month . '/' . $day . ' ' . $default_time;

		return $output;
	}
}
