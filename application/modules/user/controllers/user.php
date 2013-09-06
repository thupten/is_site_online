<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');
class User extends MX_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('User_model');
		// $this->output->enable_profiler(TRUE);
	}
	// get
	function signup() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'username', 'required|min_length[2]|is_unique[users.username]|trim|xss_clean');
		$this->form_validation->set_rules('password', 'password', 'required|matches[password1]|min_length[4]|xss_clean|md5');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[users.email]|trim');
		$this->form_validation->set_message('is_unique', 'The %s already exists.');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('signup');
		} else {
			$this->_signup_submit();
		}
	}

	function _signup_submit() {
		$data['username'] = $this->input->post('username', true);
		$data['password'] = $this->input->post('password', true);
		$data['email'] = $this->input->post('email', true);
		$id = $this->User_model->insert($data);
		if ($id > 0) {
			$this->session->set_flashdata('message', 'Signup complete');
			$this->load->view('login_block');
		} else {
			$this->session->set_flashdata('message', 'Signup failed');
			$this->load->view('signup');
		}
	}

	function preferences() {
		$rows = $this->User_model->getPreferences_for_current_user();
		$this->load->view('preferences', $rows);
	}

	function index() {
		
	}

	function _get_session_username() {
		$username = $this->session->userdata('username');
		if ($username == false) {
			return false;
		}
		return $username;
	}

	function login($view = 'login_form') {
		$logged_in_username = $this->_get_session_username();
		if ($logged_in_username != false) {
			$this->load->view('user/logout', array (
					'username' => $logged_in_username 
			));
			return;
		}
		$username = $this->input->post('username', true);
		$password = md5($this->input->post('password', true));
		if ($username != false && $password != false) {
			$returned_username = $this->User_model->get_user($username, $password);
			if ($returned_username != false) {
				// logged in..set session
				$this->session->set_userdata('username', $returned_username);
				$this->load->view('user/logout', array (
						'username' => $returned_username 
				));
				return;
			} else {
				// go back to login
				$data = array (
						'login_message' => 'invalid username or password' 
				);
				$this->load->view('user/login_form', $data);
				return;
			}
		} else {
			$this->load->view('user/login_form');
			return;
		}
	}

	function _login_submit() {
	}

	function logout() {
		$this->session->unset_userdata('username');
		session_destroy();
		redirect(site_url());
	}
}
