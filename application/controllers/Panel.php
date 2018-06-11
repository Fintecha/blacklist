<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('access') == 2 && $this->session->userdata('auth') == TRUE) {

			redirect(base_url('panel/dashboard'));
			exit;
		}

		redirect(base_url('panel/login'));
		exit;
	}

	public function login()
	{
		if ($this->session->userdata('access') == 2 && $this->session->userdata('auth') == TRUE) {

			redirect(base_url('panel/dashboard'));
			exit;
		}

		$data = array();

		$data['alert'] = $this->session->flashdata('flash');

		$this->form_validation->set_rules('username', 'نام کاربری', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'کلمه عبور', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE) {

			$this->load->view('panel/common/header', $data);
			$this->load->view('panel/member/login', $data);
			$this->load->view('panel/common/footer', $data);

		} else {

			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$hash = md5($password);

			$this->db->from('member')->where('username', $username)->where('password', $hash)->where('access', 2);

			if ($this->db->count_all_results() == 1) {

				$this->db->from('member')->where('username', $username)->where('password', $hash)->where('access', 2)->limit(1);

				$member = $this->db->get()->row();

				if ($member->status == 1) {

					$finger = array(

						'bit'    => $member->bit,
						'access' => $member->access,
						'auth'   => TRUE
					);

					$this->session->set_userdata($finger);

					$this->session->set_flashdata('flash', array('message' => 'شما با موفقیت وارد پنل شدید.', 'class' => 'success', 'icon' => 'check'));

					redirect(base_url('panel/dashboard'));
					exit;

				} else {

					$this->session->set_flashdata('flash', array('message' => 'دسترسی شما به پنل مسدود شده است.', 'class' => 'danger', 'icon' => 'close'));

					redirect(base_url('panel/login'));
					exit;
				}

			} else {

				$this->session->set_flashdata('flash', array('message' => 'نام کاربری و یا کلمه عبور اشتباه است.', 'class' => 'danger', 'icon' => 'close'));

				redirect(base_url('panel/login'));
				exit;
			}
		}
	}

	public function logout()
	{
		if ($this->session->userdata('access') == 1 || $this->session->userdata('auth') == FALSE) {

			redirect(base_url('panel/login'));
			exit;
		}

        $this->session->unset_userdata('bit');
        $this->session->unset_userdata('access');
        $this->session->unset_userdata('auth');

		$this->session->set_flashdata('flash', array('message' => 'شما با موفقیت از پنل خارج شدید.', 'class' => 'success', 'icon' => 'check'));

		redirect(base_url('panel/login'));
		exit;
	}

	public function dashboard()
	{
		if ($this->session->userdata('access') == 1 || $this->session->userdata('auth') == FALSE) {

			redirect(base_url('panel/login'));
			exit;
		}

		$data = array();

		$data['alert']  = $this->session->flashdata('flash');
		$data['member'] = $this->get_member($this->session->userdata('bit'));

		$data['date'] = mdate('%Y-%m-%d %H:%i:%s', time());

		$data['complaint'] = $this->db->from('complaint')->where('member', $this->session->userdata('bit'))->count_all_results();
		$data['inquiry']   = $this->db->from('history')->where(array(

			'member' => $this->session->userdata('bit'),
			'marker' => 3,
			'status' => 1
		))->count_all_results();

		$this->load->view('panel/common/header', $data);
		$this->load->view('panel/common/aside', $data);
		$this->load->view('panel/member/index', $data);
		$this->load->view('panel/common/footer', $data);
	}

	public function complaint($route = 'index', $bit = NULL)
	{
		if ($this->session->userdata('access') == 1 || $this->session->userdata('auth') == FALSE) {

			redirect(base_url('panel/login'));
			exit;
		}

		$route = clean($route);
		$bit   = clean($bit);

		$data = array();

		$data['alert']  = $this->session->flashdata('flash');
		$data['member'] = $this->get_member($this->session->userdata('bit'));

		if ($route == 'index') {

			$this->form_validation->set_rules('nid', 'کد ملی', 'trim|xss_clean|melli_code');
			$this->form_validation->set_rules('mobile', 'شماره موبایل', 'trim|xss_clean|is_iran_mobile');
			$this->form_validation->set_rules('domain', 'آدرس اینترنتی', 'trim|xss_clean|is_url');

			if ($this->form_validation->run() == FALSE) {

				$this->load->view('panel/common/header', $data);
				$this->load->view('panel/common/aside', $data);
				$this->load->view('panel/complaint/search', $data);
				$this->load->view('panel/common/footer');

			} else {

				$nid    = clean($this->input->post('nid', TRUE));
				$mobile = clean($this->input->post('mobile', TRUE));
				$domain = clean($this->input->post('domain', TRUE));

				$nid    = empty($nid)    ? 'NULL' : $nid;
				$mobile = empty($mobile) ? 'NULL' : $mobile;
				$domain = empty($domain) ? 'NULL' : clear_url($domain);

				$member  = $this->session->userdata('bit');
				$address = $this->input->ip_address();;
				$created = mdate('%Y-%m-%d %H:%i:%s', time());
				
				$this->db->select('complaint.name, complaint.nid, complaint.mobile, complaint.domain, reason.name AS reason, reason.point AS point, complaint.date, complaint.created, profile.brand AS issuer');
				$this->db->from('complaint')->join('reason', 'reason.bit = complaint.reason')->join('profile', 'profile.member = complaint.member');
				$this->db->group_start()->where('complaint.nid', $nid)->or_group_start()->where('complaint.mobile', $mobile)->or_group_start()->where('complaint.domain', $domain)->group_end()->group_end()->group_end();
				$this->db->where('complaint.status', 1)->order_by('complaint.bit', 'DESC');

				$complaint = [];
				$result    = $this->db->get()->result();

				if ($result) {

					foreach ($result as $item) {

						$complaint[] = (object) [

							'name'    => $item->name,
							'nid'     => $item->nid,
							'mobile'  => $item->mobile,
							'domain'  => addhttp($item->domain),
							'reason'  => $item->reason,
							'point'   => $item->point,
							'date'    => $item->date,
							'created' => $item->created,
							'issuer'  => $item->issuer,
							'count'   => $this->calculator('count', $item->nid),
							'risk'    => $this->calculator('risk', $item->nid)
						];
					}
				}

				$data['complaint'] = $complaint;

				$blob = json_encode([

					'nid'    => ($nid == 'NULL')    ? NULL : $nid,
					'mobile' => ($mobile == 'NULL') ? NULL : $mobile,
					'domain' => ($domain == 'NULL') ? NULL : $domain
				]);

				$this->history($member, 3, $blob, $address, '200', '700', 1);

				$this->load->view('panel/common/header', $data);
				$this->load->view('panel/common/aside', $data);
				$this->load->view('panel/complaint/index', $data);
				$this->load->view('panel/common/footer', $data);
			}

		} elseif ($route == 'list') {

			$this->db->select('complaint.name, complaint.nid, complaint.mobile, complaint.domain, reason.name AS reason, reason.point AS point, complaint.date, complaint.created, profile.brand AS issuer');
			$this->db->from('complaint')->join('reason', 'reason.bit = complaint.reason')->join('profile', 'profile.member = complaint.member');
			$this->db->where('complaint.status', 1)->order_by('complaint.bit', 'DESC');

			$complaint = [];
			$result    = $this->db->get()->result();
			
			if ($result) {
			
				foreach ($result as $item) {
			
					$complaint[] = (object) [
			
						'name'    => $item->name,
						'nid'     => $item->nid,
						'mobile'  => $item->mobile,
						'domain'  => addhttp($item->domain),
						'reason'  => $item->reason,
						'point'   => $item->point,
						'date'    => $item->date,
						'created' => $item->created,
						'issuer'  => $item->issuer,
						'count'   => $this->calculator('count', $item->nid),
						'risk'    => $this->calculator('risk', $item->nid)
					];
				}
			}
			
			$data['complaint'] = $complaint;

			$this->load->view('panel/common/header', $data);
			$this->load->view('panel/common/aside', $data);
			$this->load->view('panel/complaint/list', $data);
			$this->load->view('panel/common/footer', $data);

		} elseif ($route == 'create') {

			$this->form_validation->set_rules('name', 'نام پذیرنده', 'trim|xss_clean|required|min_length[5]|max_length[120]|is_alphabet');
			$this->form_validation->set_rules('nid', 'کد ملی', 'trim|xss_clean|required|melli_code');
			$this->form_validation->set_rules('mobile', 'شماره موبایل', 'trim|xss_clean|is_iran_mobile');
			$this->form_validation->set_rules('domain', 'آدرس اینترنتی', 'trim|xss_clean|is_url');
			$this->form_validation->set_rules('reason', 'نوع تخلف', 'trim|xss_clean|required|numeric');
			$this->form_validation->set_rules('date', 'زمان انجام تخلف', 'trim|xss_clean|is_shamsi');

			if ($this->form_validation->run() == FALSE) {

				$data['reason'] = $this->get_reason();

				$this->load->view('panel/common/header', $data);
				$this->load->view('panel/common/aside', $data);
				$this->load->view('panel/complaint/create', $data);
				$this->load->view('panel/common/footer');

			} else {

				$name   = clean($this->input->post('name', TRUE));
				$nid    = clean($this->input->post('nid', TRUE));
				$mobile = clean($this->input->post('mobile', TRUE));
				$domain = clean($this->input->post('domain', TRUE));
				$reason = clean($this->input->post('reason', TRUE));
				$date   = clean($this->input->post('date', TRUE));

				$mobile  = empty($mobile) ? NULL : $mobile;
				$domain  = empty($domain) ? NULL : clear_url($domain);
				$date    = empty($date)   ? NULL : $date;

				$member  = $this->session->userdata('bit');
				$created = mdate('%Y-%m-%d %H:%i:%s', time());

				$insert = array(

					'member'   => $member,
					'name'     => $name,
					'nid'      => $nid,
					'mobile'   => $mobile,
					'domain'   => $domain,
					'reason'   => $reason,
					'date'     => $date,
					'method'   => 2,
					'created'  => $created,
					'status'   => 1
				);

				$this->db->insert('complaint', $insert);

				$this->session->set_flashdata('flash', array('message' => 'گزارش تخلف با موفقیت ثبت شد.', 'class' => 'success', 'icon' => 'close'));

				redirect(base_url('panel/dashboard'));
				exit;
			}

		} else {

			$this->session->set_flashdata('flash', array('message' => 'درخواست ارسالی شما معتبر نمی باشد.', 'class' => 'danger', 'icon' => 'check'));

			redirect(base_url('panel/dashboard'));
			exit;
		}
	}

	public function token()
	{
		if ($this->session->userdata('access') == 1 || $this->session->userdata('auth') == FALSE) {

			redirect(base_url('panel/login'));
			exit;
		}

		$data = array();

		$data['alert']  = $this->session->flashdata('flash');
		$data['member'] = $this->get_member($this->session->userdata('bit'));
		$data['token']  = $this->db->from('token')->where('member', $this->session->userdata('bit'))->get()->result();

		$this->load->view('panel/common/header', $data);
		$this->load->view('panel/common/aside', $data);
		$this->load->view('panel/token/index', $data);
		$this->load->view('panel/common/footer', $data);
	}

	public function password()
	{
		if ($this->session->userdata('access') == 1 || $this->session->userdata('auth') == FALSE) {

			redirect(base_url('panel/login'));
			exit;
		}

		$data = array();

		$data['alert']  = $this->session->flashdata('flash');
		$data['member'] = $this->get_member($this->session->userdata('bit'));

		$this->form_validation->set_rules('current', 'کلمه عبور فعلی', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'کلمه عبور جدید', 'trim|required|xss_clean|min_length[6]');
		$this->form_validation->set_rules('confirm', 'تکرار کلمه عبور جدید', 'trim|required|xss_clean|min_length[6]|matches[password]');

		if ($this->form_validation->run() == FALSE) {

			$this->load->view('panel/common/header', $data);
			$this->load->view('panel/common/aside', $data);
			$this->load->view('panel/member/password', $data);
			$this->load->view('panel/common/footer', $data);

		} else {

			$current  = md5($this->input->post('current'));
			$password = md5($this->input->post('password'));

			$this->db->from('member')->where('bit', $this->session->userdata('bit'))->where('password', $current);

			if ($this->db->count_all_results() == 1) {

				$modified = mdate('%Y-%m-%d %H:%i:%s', time());

				$update = array(

					'password' => $password,
					'modified' => $modified
				);

				$this->db->where('bit', $this->session->userdata('bit'))->update('member', $update);

				$this->session->set_flashdata('flash', array('message' => 'کلمه عبور با موفقیت تغییر پیدا کرد.', 'class' => 'success', 'icon' => 'check'));

				redirect(base_url('panel/password'));
				exit;

			} else {

				$this->session->set_flashdata('flash', array('message' => 'کلمه عبور فعلی اشتباه است.', 'class' => 'danger', 'icon' => 'close'));

				redirect(base_url('panel/password'));
				exit;
			}
		}
	}
	
	public function feedback()
	{
		if ($this->session->userdata('access') == 1 || $this->session->userdata('auth') == FALSE) {
	
			redirect(base_url('panel/login'));
			exit;
		}
	
		$this->session->set_flashdata('flash', array('message' => 'این امکان در حال حاضر برای شما در دسترس نمی باشد.', 'class' => 'danger', 'icon' => 'close'));
	
		redirect(base_url('panel/dashboard'));
		exit;
	}

	private function get_member($bit = NULL)
	{
		$bit = clean($bit);

		$this->db->from('profile');
		$this->db->where('member', $bit);

		return $this->db->get()->row();
	}

	private function get_reason()
	{
		$this->db->from('reason')->order_by('bit', 'DESC');

		return $this->db->get()->result();
	}

	private function history($member, $marker, $blob, $server, $http, $internal, $status)
	{
		$created = mdate('%Y-%m-%d %H:%i:%s', time());

		$insert = [

			'member'   => $member,
			'marker'   => $marker,
			'data'     => $blob,
			'method'   => 2,
			'server'   => $server,
			'http'     => $http,
			'internal' => $internal,
			'created'  => $created,
			'status'   => $status
		];

		$this->db->insert('history', $insert);
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
