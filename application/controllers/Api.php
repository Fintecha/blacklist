<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function reason()
	{
		$status = 2;
		$method = clean($this->input->method(FALSE));
		$token  = clean($this->input->post_get('token', TRUE));
		$server = clean($this->input->server('REMOTE_ADDR'));

		$blob = json_encode([

			'token' => empty($token)  ? NULL : $token
		]);

		if ($method == 'get') {

			$this->history($token, 1, $blob, $server, '422', '101', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_method_allowed'),
				'help'    => NULL
			]));
		}

		if ($this->limit($server)) {

			$this->history($token, 1, $blob, $server, '422', '102', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_many_requests'),
				'help'    => $this->lang->line('api_many_requests_help')
            ]));
		}

		if ($this->form_validation->required($token) == FALSE) {

			$this->history($token, 1, $blob, $server, '422', '103', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_token_required'),
				'help'    => NULL
            ]));
		}

		$this->db->from('token')->where('token', $token)->where('status', 1);

		if ($this->db->count_all_results() == 1) {

			$this->db->from('token')->where('token', $token)->where('server', $server);

			if ($this->db->count_all_results() == 1) {

				$this->db->select('bit AS id, name')->from('reason')->order_by('bit', 'DESC');

				$status = 1;
				$reason = $this->db->get()->result();

				$this->history($token, 1, $blob, $server, '200', '201', $status);

				return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(200)->set_output(json_encode([

					'status' => 1,
					'data'   => $reason
				]));

			} else {

				$this->history($token, 1, $blob, $server, '422', '104', $status);

				return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

					'status'  => -1,
					'message' => $this->lang->line('api_client_permission'),
					'help'    => NULL
				]));
			}

		} else {

			$this->history($token, 1, $blob, $server, '422', '105', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_token_inactive'),
				'help'    => NULL
            ]));
		}
	}

	public function create()
	{
		$status = 2;
		$method = clean($this->input->method(FALSE));
		$token  = clean($this->input->post_get('token', TRUE));
		$name   = clean($this->input->post_get('name', TRUE));
		$nid    = clean($this->input->post_get('nid', TRUE));
		$mobile = clean($this->input->post_get('mobile', TRUE));
		$domain = clean($this->input->post_get('domain', TRUE));
		$reason = clean($this->input->post_get('reason', TRUE));
		$date   = clean($this->input->post_get('date', TRUE));
		$server = clean($this->input->server('REMOTE_ADDR'));

		$blob = json_encode([

			'token'  => empty($token)  ? NULL : $token,
			'name'   => empty($name)   ? NULL : $name,
			'nid'    => empty($nid)    ? NULL : $nid,
			'mobile' => empty($mobile) ? NULL : $mobile,
			'domain' => empty($domain) ? NULL : $domain,
			'reason' => empty($reason) ? NULL : $reason,
			'date'   => empty($date)   ? NULL : $date
		]);

		if ($method == 'get') {

			$this->history($token, 2, $blob, $server, '422', '106', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_method_allowed'),
				'help'    => NULL
			]));
		}

		if ($this->limit($server)) {

			$this->history($token, 2, $blob, $server, '422', '107', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_many_requests'),
				'help'    => $this->lang->line('api_many_requests_help')
            ]));
		}

		if ($this->form_validation->required($token) == FALSE) {

			$this->history($token, 2, $blob, $server, '422', '108', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_token_required'),
				'help'    => NULL
            ]));
		}

		if ($this->form_validation->required($name) == FALSE) {

			$this->history($token, 2, $blob, $server, '422', '109', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_name_required'),
				'help'    => NULL
			]));
		}

		if ($this->form_validation->min_length($name, 5) == FALSE || $this->form_validation->max_length($name, 120) == FALSE) {

			$this->history($token, 2, $blob, $server, '422', '110', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_name_length'),
				'help'    => NULL
			]));
		}

		if ($this->form_validation->is_alphabet($name) == FALSE) {

			$this->history($token, 2, $blob, $server, '422', '111', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_name_alphabet'),
				'help'    => NULL
			]));
		}

		if ($this->form_validation->required($nid) == FALSE) {

			$this->history($token, 2, $blob, $server, '422', '112', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_nid_required'),
				'help'    => NULL
			]));
		}

		if ($this->form_validation->melli_code($nid) == FALSE) {

			$this->history($token, 2, $blob, $server, '422', '113', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_nid_invalid'),
				'help'    => NULL
			]));
		}

		if ($mobile && $this->form_validation->is_iran_mobile($mobile) == FALSE) {

			$this->history($token, 2, $blob, $server, '422', '114', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_mobile_invalid'),
				'help'    => NULL
			]));
		}

		if ($domain && $this->form_validation->is_url($domain) == FALSE) {

			$this->history($token, 2, $blob, $server, '422', '115', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_domain_invalid'),
				'help'    => NULL
			]));
		}

		if ($this->form_validation->required($reason) == FALSE) {

			$this->history($token, 2, $blob, $server, '422', '116', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_reason_required'),
				'help'    => NULL
			]));
		}

		if ($this->form_validation->numeric($reason) == FALSE || $this->form_validation->is_unique($reason, 'reason.bit')) {

			$this->history($token, 2, $blob, $server, '422', '117', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_reason_invalid'),
				'help'    => $this->lang->line('api_reason_invalid_help')
			]));
		}

		if ($date && $this->form_validation->is_shamsi($date) == FALSE) {

			$this->history($token, 2, $blob, $server, '422', '118', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_date_invalid'),
				'help'    => NULL
			]));
		}

		$this->db->from('token')->where('token', $token)->where('status', 1);

		if ($this->db->count_all_results() == 1) {

			$this->db->from('token')->where('token', $token)->where('server', $server);

			if ($this->db->count_all_results() == 1) {

				$this->db->from('token')->where('token', $token)->limit(1);

				$mobile = empty($mobile) ? NULL : $mobile;
				$domain = empty($domain) ? NULL : clear_url($domain);
				$date   = empty($date)   ? NULL : $date;

				$member  = $this->db->get()->row()->member;
				$created = mdate('%Y-%m-%d %H:%i:%s', time());

				$insert = [

					'member'   => $member,
					'name'     => $name,
					'nid'      => $nid,
					'mobile'   => $mobile,
					'domain'   => $domain,
					'reason'   => $reason,
					'date'     => $date,
					'method'   => 1,
					'created'  => $created,
					'status'   => 1
				];

				$this->db->insert('complaint', $insert);

				if ($this->db->affected_rows() > 0) {

					$status    = 1;
					$reference = $this->db->insert_id();

					$this->history($token, 2, $blob, $server, '200', '202', $status);

					return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(200)->set_output(json_encode([

						'status' => 1,
						'data'   => [

							'reference' => $reference
						]
					]));

				} else {

					$this->history($token, 2, $blob, $server, '422', '119', $status);

					return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

						'status'  => -1,
						'message' => $this->lang->line('api_faild'),
						'help'    => NULL
					]));
				}

			} else {

				$this->history($token, 2, $blob, $server, '422', '120', $status);

				return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

					'status'  => -1,
					'message' => $this->lang->line('api_client_permission'),
					'help'    => NULL
				]));
			}

		} else {

			$this->history($token, 2, $blob, $server, '422', '121', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_token_inactive'),
				'help'    => NULL
            ]));
		}
	}

	public function inquiry()
	{
		$status = 2;
		$method = clean($this->input->method(FALSE));
		$token  = clean($this->input->post_get('token', TRUE));
		$nid    = clean($this->input->post_get('nid', TRUE));
		$mobile = clean($this->input->post_get('mobile', TRUE));
		$domain = clean($this->input->post_get('domain', TRUE));
		$server = clean($this->input->server('REMOTE_ADDR'));

		$blob = json_encode([

			'token'  => empty($token)  ? NULL : $token,
			'nid'    => empty($nid)    ? NULL : $nid,
			'mobile' => empty($mobile) ? NULL : $mobile,
			'domain' => empty($domain) ? NULL : $domain
		]);

		if ($method == 'get') {

			$this->history($token, 3, $blob, $server, '422', '122', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_method_allowed'),
				'help'    => NULL
            ]));
		}

		if ($this->limit($server)) {

			$this->history($token, 3, $blob, $server, '422', '123', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_many_requests'),
				'help'    => $this->lang->line('api_many_requests_help')
            ]));
		}

		if ($this->form_validation->required($token) == FALSE) {

			$this->history($token, 3, $blob, $server, '422', '124', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_token_required'),
				'help'    => NULL
            ]));
		}

		$this->db->from('token')->where('token', $token)->where('status', 1);

		if ($this->db->count_all_results() == 1) {

			$this->db->from('token')->where('token', $token)->where('server', $server);

			if ($this->db->count_all_results() == 1) {

				$status = 1;
				$nid    = empty($nid)    ? 'NULL' : $nid;
				$mobile = empty($mobile) ? 'NULL' : $mobile;
				$domain = empty($domain) ? 'NULL' : clear_url($domain);

				$this->db->select('complaint.name, complaint.nid, complaint.mobile, complaint.domain, reason.name AS reason, reason.point AS point, complaint.date, complaint.created, profile.brand AS issuer');
				$this->db->from('complaint')->join('reason', 'reason.bit = complaint.reason')->join('profile', 'profile.member = complaint.member');
				$this->db->group_start()->where('complaint.nid', $nid)->or_group_start()->where('complaint.mobile', $mobile)->or_group_start()->where('complaint.domain', $domain)->group_end()->group_end()->group_end();
				$this->db->where('complaint.status', 1)->order_by('complaint.bit', 'DESC');

				$complaint = $this->db->get()->result();

				if ($complaint) {

					$report = [];
					$count  = count($complaint);

					foreach ($complaint as $item) {

						$report[] = [

							'name'    => $item->name,
							'nid'     => $item->nid,
							'mobile'  => $item->mobile,
							'domain'  => addhttp($item->domain),
							'reason'  => $item->reason,
							'point'   => $item->point,
							'date'    => $item->date,
							'created' => shamsi($item->created),
							'issuer'  => $item->issuer,
							'count'   => $this->calculator('count', $item->nid),
							'risk'    => $this->calculator('risk', $item->nid)
						];
					}

					$this->history($token, 3, $blob, $server, '200', '203', $status);

					return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(200)->set_output(json_encode([

						'status' => 1,
						'data'   => [

							'count'  => $count,
							'report' => $report
						]
					]));

				} else {

					$this->history($token, 3, $blob, $server,'200', '204', $status);

					return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(200)->set_output(json_encode([

						'status' => 1,
						'data'   => [

							'count'  => 0,
							'report' => NULL
						]
					]));
				}

			} else {

				$this->history($token, 3, $blob, $server, '422', '126', $status);

				return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

					'status'  => -1,
					'message' => $this->lang->line('api_client_permission'),
					'help'    => NULL
				]));
			}

		} else {

			$this->history($token, 3, $blob, $server, '422', '127', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_token_inactive'),
				'help'    => NULL
            ]));
		}
	}

	public function report()
	{
		$status = 2;
		$method = clean($this->input->method(FALSE));
		$token  = clean($this->input->post_get('token', TRUE));
		$offset = clean($this->input->post_get('offset', TRUE));
		$server = clean($this->input->server('REMOTE_ADDR'));

		$blob = json_encode([

			'token'  => empty($token)  ? NULL : $token,
			'offset' => empty($offset) ? NULL : $offset
		]);

		if ($method == 'get') {

			$this->history($token, 4, $blob, $server, '422', '128', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_method_allowed'),
				'help'    => NULL
            ]));
		}

		if ($this->limit($server)) {

			$this->history($token, 4, $blob, $server, '422', '129', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_many_requests'),
				'help'    => $this->lang->line('api_many_requests_help')
            ]));
		}

		if ($this->form_validation->required($token) == FALSE) {

			$this->history($token, 4, $blob, $server, '422', '130', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_token_required'),
				'help'    => NULL
            ]));
		}

		if ($offset && $this->form_validation->numeric($offset) == FALSE) {

			$this->history($token, 4, $blob, $server, '422', '131', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_offset_numeric'),
				'help'    => NULL
            ]));
		}

		/*if () {

			$this->history($token, 4, $blob, $server, '422', '132', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_offset_invalid'),
				'help'    => $this->lang->line('api_offset_invalid_help')
            ]));
		}*/

		$this->db->from('token')->where('token', $token)->where('status', 1);

		if ($this->db->count_all_results() == 1) {

			$this->db->from('token')->where('token', $token)->where('server', $server);

			if ($this->db->count_all_results() == 1) {

				$status = 1;
				$offset = empty($offset) ? 0 : $offset;

				$this->db->select('complaint.name, complaint.nid, complaint.mobile, complaint.domain, reason.name AS reason, reason.point AS point, complaint.date, complaint.created, profile.brand AS issuer');
				$this->db->from('complaint')->join('reason', 'reason.bit = complaint.reason')->join('profile', 'profile.member = complaint.member');
				$this->db->where('complaint.status', 1)->order_by('complaint.bit', 'DESC')->limit(50, $offset);

				$complaint = $this->db->get()->result();

				if ($complaint) {

					$report = [];
					$count  = count($complaint);

					foreach ($complaint as $item) {

						$report[] = [

							'name'    => $item->name,
							'nid'     => $item->nid,
							'mobile'  => $item->mobile,
							'domain'  => addhttp($item->domain),
							'reason'  => $item->reason,
							'point'   => $item->point,
							'date'    => $item->date,
							'created' => shamsi($item->created),
							'issuer'  => $item->issuer,
							'count'   => $this->calculator('count', $item->nid),
							'risk'    => $this->calculator('risk', $item->nid)
						];
					}

					$this->history($token, 4, $blob, $server, '200', '205', $status);

					return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(200)->set_output(json_encode([

						'status' => 1,
						'data'   => [

							'offset' => $offset,
							'count'  => $count,
							'report' => $report
						]
					]));

				} else {

					$this->history($token, 4, $blob, $server,'200', '206', $status);

					return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(200)->set_output(json_encode([

						'status' => 1,
						'data'   => [

							'offset' => $offset,
							'count'  => 0,
							'report' => NULL
						]
					]));
				}

			} else {

				$this->history($token, 4, $blob, $server, '422', '133', $status);

				return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

					'status'  => -1,
					'message' => $this->lang->line('api_client_permission'),
					'help'    => NULL
				]));
			}

		} else {

			$this->history($token, 4, $blob, $server, '422', '134', $status);

			return $this->output->set_content_type('application/json', 'utf-8')->set_status_header(422)->set_output(json_encode([

				'status'  => -1,
				'message' => $this->lang->line('api_token_inactive'),
				'help'    => NULL
            ]));
		}
	}

	private function history($token = NULL, $marker, $blob, $server, $http, $internal, $status)
	{
		$this->db->from('token')->where('token', $token);

		if ($this->db->count_all_results() == 1) {

			$this->db->from('token')->where('token', $token)->limit(1);

			$member = $this->db->get()->row()->member;

		} else {

			$member = NULL;
		}

		$created = mdate('%Y-%m-%d %H:%i:%s', time());

		$insert = [

			'member'   => $member,
			'marker'   => $marker,
			'data'     => $blob,
			'method'   => 1,
			'server'   => $server,
			'http'     => $http,
			'internal' => $internal,
			'created'  => $created,
			'status'   => $status
		];

		$this->db->insert('history', $insert);
	}

	private function limit($server = NULL) {

		$this->db->from('history')->where('server', $server)->where_not_in('http', '422')->order_by('bit', 'DESC')->limit(1);

		$history = $this->db->get()->row();

		if ($history) {

			if (strtotime($history->created) > strtotime('-10 seconds')) {

				return TRUE;
			}
		}

		return FALSE;
	}

	private function calculator($mode, $nid = NULL) {

		if ($mode == 'count') {

			$this->db->from('complaint')->where('nid', $nid)->where('status', 1);

			return $this->db->count_all_results();
		}

		if ($mode == 'risk') {

			$this->db->select('SUM(reason.point) AS point')->from('complaint');
			$this->db->join('reason', 'reason.bit = complaint.reason')->where('complaint.nid', $nid)->where('complaint.status', 1);

			return $this->db->get()->row()->point;
		}

		return NULL;
	}
}
