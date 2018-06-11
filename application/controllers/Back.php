<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Back extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('access') == 1 && $this->session->userdata('auth') == TRUE) {

			redirect(base_url('back/dashboard'));
			exit;
		}

		redirect(base_url('back/login'));
		exit;
	}

	public function login()
	{
		if ($this->session->userdata('access') == 1 && $this->session->userdata('auth') == TRUE) {

			redirect(base_url('back/dashboard'));
			exit;
		}

		$data = array();

		$data['alert'] = $this->session->flashdata('flash');

		$this->form_validation->set_rules('username', 'نام کاربری', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'کلمه عبور', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE) {

			$this->load->view('back/common/header', $data);
			$this->load->view('back/member/login', $data);
			$this->load->view('back/common/footer', $data);

		} else {

			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$hash = md5($password);

			$this->db->from('member')->where('username', $username)->where('password', $hash)->where('access', 1);

			if ($this->db->count_all_results() == 1) {

				$this->db->from('member')->where('username', $username)->where('password', $hash)->where('access', 1)->limit(1);

				$member = $this->db->get()->row();

				if ($member->status == 1) {

					$finger = array(

						'bit'    => $member->bit,
						'access' => $member->access,
						'auth'   => TRUE
					);

					$this->session->set_userdata($finger);

					$this->session->set_flashdata('flash', array('message' => 'شما با موفقیت وارد پنل شدید.', 'class' => 'success', 'icon' => 'check'));

					redirect(base_url('back/dashboard'));
					exit;

				} else {

					$this->session->set_flashdata('flash', array('message' => 'دسترسی شما به پنل مسدود شده است.', 'class' => 'danger', 'icon' => 'close'));

					redirect(base_url('back/login'));
					exit;
				}

			} else {

				$this->session->set_flashdata('flash', array('message' => 'نام کاربری و یا کلمه عبور اشتباه است.', 'class' => 'danger', 'icon' => 'close'));

				redirect(base_url('back/login'));
				exit;
			}
		}
	}

	public function logout()
	{
		if ($this->session->userdata('access') == 2 || $this->session->userdata('auth') == FALSE) {

			redirect(base_url('back/login'));
			exit;
		}

        $this->session->unset_userdata('bit');
        $this->session->unset_userdata('access');
        $this->session->unset_userdata('auth');

		$this->session->set_flashdata('flash', array('message' => 'شما با موفقیت از پنل خارج شدید.', 'class' => 'success', 'icon' => 'check'));

		redirect(base_url('back/login'));
		exit;
	}

	public function dashboard()
	{
		if ($this->session->userdata('access') == 2 || $this->session->userdata('auth') == FALSE) {

			redirect(base_url('back/login'));
			exit;
		}

		$data = array();

		$data['alert']  = $this->session->flashdata('flash');
		$data['member'] = $this->get_member($this->session->userdata('bit'));

		$data['date'] = mdate('%Y-%m-%d %H:%i:%s', time());

		$data['complaint'] = $this->db->from('complaint')->count_all_results();
		$data['user']      = $this->db->from('member')->where('access', 2)->count_all_results();
		$data['admin']     = $this->db->from('member')->where('access', 1)->count_all_results();
		$data['inquiry']   = $this->db->from('history')->where(array(

			'marker' => 3,
			'status' => 1
		))->count_all_results();

		$this->load->view('back/common/header', $data);
		$this->load->view('back/common/aside', $data);
		$this->load->view('back/member/index', $data);
		$this->load->view('back/common/footer', $data);
	}

	public function complaint($route = 'index', $bit = NULL)
	{
		if ($this->session->userdata('access') == 2 || $this->session->userdata('auth') == FALSE) {

			redirect(base_url('back/login'));
			exit;
		}

		$route = xss_clean($route);
		$bit   = xss_clean($bit);

		$data = array();

		$data['alert']  = $this->session->flashdata('flash');
		$data['member'] = $this->get_member($this->session->userdata('bit'));
	}

	public function member($route = 'index', $bit = NULL)
	{
		if ($this->session->userdata('access') == 2 || $this->session->userdata('auth') == FALSE) {

			redirect(base_url('back/login'));
			exit;
		}

		$route = xss_clean($route);
		$bit   = xss_clean($bit);

		$data = array();

		$data['alert']  = $this->session->flashdata('flash');
		$data['member'] = $this->get_member($this->session->userdata('bit'));
	}

	public function reason($route = 'index', $bit = NULL)
	{
		if ($this->session->userdata('access') == 2 || $this->session->userdata('auth') == FALSE) {

			redirect(base_url('back/login'));
			exit;
		}

		$route = xss_clean($route);
		$bit   = xss_clean($bit);

		$data = array();

		$data['alert']  = $this->session->flashdata('flash');
		$data['member'] = $this->get_member($this->session->userdata('bit'));
	}

	public function history($route = 'index', $bit = NULL)
	{
		if ($this->session->userdata('access') == 2 || $this->session->userdata('auth') == FALSE) {

			redirect(base_url('back/login'));
			exit;
		}

		$route = xss_clean($route);
		$bit   = xss_clean($bit);

		$data = array();

		$data['alert']  = $this->session->flashdata('flash');
		$data['member'] = $this->get_member($this->session->userdata('bit'));
	}

	public function setting()
	{
		if ($this->session->userdata('access') == 2 || $this->session->userdata('auth') == FALSE) {

			redirect(base_url('back/login'));
			exit;
		}

		$route = xss_clean($route);
		$bit   = xss_clean($bit);

		$data = array();

		$data['alert']  = $this->session->flashdata('flash');
		$data['member'] = $this->get_member($this->session->userdata('bit'));
	}

	public function password()
	{
		if ($this->session->userdata('access') == 2 || $this->session->userdata('auth') == FALSE) {

			redirect(base_url('back/login'));
			exit;
		}

		$data = array();

		$data['alert']  = $this->session->flashdata('flash');
		$data['member'] = $this->get_member($this->session->userdata('bit'));

		$this->form_validation->set_rules('current', 'کلمه عبور فعلی', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'کلمه عبور جدید', 'trim|required|xss_clean|min_length[6]');
		$this->form_validation->set_rules('confirm', 'تکرار کلمه عبور جدید', 'trim|required|xss_clean|min_length[6]|matches[password]');

		if ($this->form_validation->run() == FALSE) {

			$this->load->view('back/common/header', $data);
			$this->load->view('back/common/aside', $data);
			$this->load->view('back/member/password', $data);
			$this->load->view('back/common/footer', $data);

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

				redirect(base_url('back/password'));
				exit;

			} else {

				$this->session->set_flashdata('flash', array('message' => 'کلمه عبور فعلی اشتباه است.', 'class' => 'danger', 'icon' => 'close'));

				redirect(base_url('back/password'));
				exit;
			}
		}
	}

	private function get_member($bit = NULL)
	{
		$bit = xss_clean($bit);

		$this->db->from('profile');
		$this->db->where('member', $bit);

		return $this->db->get()->row();
	}

	private function get_reason()
	{
		$this->db->from('reason')->order_by('bit', 'DESC');

		return $this->db->get()->result();
	}
}
