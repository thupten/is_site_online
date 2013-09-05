<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');
class User extends MX_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('User_model');
		$this->output->enable_profiler(TRUE);
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
		$session_array = $this->session->userdata('logged_in');
		if ($session_array == false) {
			return false;
		}
		$username = $session_array['username'];
		return $username;
	}

	function login($view = 'login_form') {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'username', 'required|xss_clean');
		$this->form_validation->set_rules('password', 'password', 'required|xss_clean|md5');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view($view);
		} else {
			if ($this->_login_submit() == true) {
				// could have redirect to member page..but rather want to return true
				// because this module should not be aware of member controller.
				return true;
			} else {
				// login failed
				$this->session->set_flashdata('login_message', 'invalid username or password');
				redirect('user/login');
			}
		}
	}

	function _login_submit() {
		$username = $this->input->post('username', true);
		$password = $this->input->post('password', true);
		$returned_username = $this->User_model->get_user($username, $password);
		if ($username == $returned_username) {
			// logged in..set session
			$this->session->set_userdata('logged_in_user', $username);
			return true;
		} else {
			// go back to login
			return false;
		}
	}

	function logout() {
		$this->session->unset_userdata('logged_in_user');
		session_destroy();
		redirect('start', 'refresh');
	}
}
