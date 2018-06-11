<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (function_exists('token_status') == FALSE) {

	function token_status($input, $mode) {

		switch ((string) $input) {

			case 1:
				$output = array(

					'value' => 'فعال',
					'class' => 'success',
					'icon'  => 'check'
				);
				break;

			case 2:
				$output = array(

					'value' => 'مسدود',
					'class' => 'danger',
					'icon'  => 'ban'
				);
				break;

			default:
				$output = array(

					'value' => 'خطا',
					'class' => 'danger',
					'icon'  => 'close'
				);
		}

		if ((string) $mode == 'value') return $output['value'];
		if ((string) $mode == 'class') return $output['class'];
		if ((string) $mode == 'icon')  return $output['icon'];
	}
}
