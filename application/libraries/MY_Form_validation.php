<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{
	public function is_alphabet($input)
	{
		$output = (bool) preg_match('/^[\x{600}-\x{6FF}\x{200c}\x{064b}\x{064d}\x{064c}\x{064e}\x{064f}\x{0650}\x{0651}\s]+$/u', $input);

		return $output;
	}

	public function melli_code($input)
	{
		if (!preg_match('/^\d{8,10}$/', $input) || preg_match('/^[0]{10}|[1]{10}|[2]{10}|[3]{10}|[4]{10}|[5]{10}|[6]{10}|[7]{10}|[8]{10}|[9]{10}$/', $input)) {

			return FALSE;
		}

		$sub = 0;

		if (strlen($input) == 8) {

			$input = '00' . $input;

		} elseif (strlen($input) == 9) {

			$input = '0' . $input;
		}

		for ($i = 0; $i <= 8; $i++) {

			$sub = $sub + ($input[$i] * (10 - $i));
		}

		if (($sub % 11) < 2) {

			$control = ($sub % 11);

		} else {

			$control = 11 - ($sub % 11);
		}

		if ($input[9] == $control) {

			return TRUE;

		} else {

			return FALSE;
		}
	}

	public function is_iran_mobile($input)
	{
		if ((bool) preg_match('/^(((98)|(\+98)|(0098)|0)(9){1}[0-9]{9})+$/', $input) || (bool) preg_match('/^(9){1}[0-9]{9}+$/', $input)) {

			return TRUE;
		}

		return FALSE;
	}

	public function is_url($input)
	{
		$output = (bool) preg_match('/^(HTTP|http(s)?:\/\/(www\.)?[A-Za-z0-9]+([\-\.]{1,2}[A-Za-z0-9]+)*\.[A-Za-z]{2,40}(:[0-9]{1,40})?(\/.*)?)$/', $input);

		return $output;
	}

	public function is_shamsi($input)
	{
		if (preg_match('/^[0-9]{4}\/(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])$/', $input)) {

			return TRUE;
		}

		return FALSE;
	}

	public function limited_array($input, $params)
	{
		if (is_array($input)) {

			if (isset($params[0])) {

			   return ((count($input) <= $params[0]) ? TRUE : FALSE);

			} else {

				return TRUE;
			}
		}

		return FALSE;
	}
}
