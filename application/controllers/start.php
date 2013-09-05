<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');
class Start extends MX_Controller {

	function __construct() {
		parent::__construct();
		$this->output->enable_profiler(TRUE);
	}

	function index() {
		$data['recently_checked_sites_module_snippet'] = Modules::run('quick_check/get_recently_checked_sites', 5);
		$data['run_a_quick_check_form'] = Modules::run('quick_check/get_run_quick_check_form');
		$this->load->view('start_view', $data);
	}

	function _get_publicly_checked_project($qty) {
		$query = $this->db->get_where($this->table, array (
				'user_id' => '0'
		)
		)->order_by('id', 'desc');
		return $query->result();
	
	}
	
	function login() {
		if ($this->_get_session_username() != false) {
			redirect('member/index');
		}
		$data = $this->session->flashdata('error');
		if ($data != false) {
			$this->load->view('login_view', $data);
		} else {
			$this->load->view('login_view');
		}
	}
	
	// login
	function verify_login() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if ($this->_check_database_cb($username, $password) == true) {
			redirect('member/index', 'refresh');
		} else {
			$this->session->set_flashdata('error', array (
					'error_msg',
					'Invalid username or password.' 
			));
			redirect('start/login', 'refresh');
		}
	}

	function _check_database_cb($username, $password) {
		$result = $this->User_model->get($username, $password);
		if ($result != false) {
			$session_array = array ();
			foreach ( $result as $row ) {
				$session_array = array (
						'username' => $row->username 
				);
				$this->session->set_userdata('logged_in', $session_array);
			}
			return true;
		} else {
			return FALSE;
		}
	}

	function about() {
		$this->load->view('layout/start_about_view');
	}

	function contact() {
		$this->load->view('layout/start_contact_view');
	}

	function _get_session_username() {
		$session_array = $this->session->userdata('logged_in');
		if ($session_array == false) {
			return false;
		}
		$owner = $session_array ['username'];
		return $owner;
	}
}
