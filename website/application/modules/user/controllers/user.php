<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

class User extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('User_model');
		$this->output->enable_profiler(TRUE);
	}

	function delete_profile($redirect_url = ""){
		$where ['token'] = $this->session->user_data('token');
		$response = $this->User_model->delete_user($where);
		if (array_key_exists('error_message', $response)){
			$this->load->view('error_view', array (
					'error' => $response ));
			$this->session->unset_userdata('token');
			return;
		}
		$this->session->set_flashdata('message', 'Delete complete');
		$this->session->unset_userdata('token');
		session_destroy();
		if ($redirect_url != ""){
			redirect($redirect_url, 'refresh');
		}
	}

	function edit_profile($redirect_url = ""){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'password', 'min_length[4]|xss_clean');
		$this->form_validation->set_rules('new_password', 'password', 'min_length[4]|xss_clean');
		$this->form_validation->set_rules('email', 'email', 'valid_email|is_unique[users.email]|trim');
		$this->form_validation->set_message('is_unique', 'The %s already exists.');
		if ($this->form_validation->run() == FALSE){
			$token = $this->session->user_data('token');
			$this->load->view('edit_profile', array (
					'token' => $token ));
			return;
		}
		// validation is true
		$where ['token'] = $this->session->user_data('token');
		$data ['password'] = $this->input->post('password', true);
		$data ['email'] = $this->input->post('email', true);
		$user = $this->User_model->update_user($data, $where);
		if (array_key_exists('error_message', $user)){
			$this->load->view('error_view', array (
					'error' => $user ));
			$this->session->unset_userdata('token');
			return;
		} else{
			$this->session->set_flashdata('message', 'Update complete');
			$this->session->set_userdata('token', $where ['token']);
			if ($redirect_url != ""){
				redirect($redirect_url, 'refresh');
			}
			return;
		}
	}
	// get
	function signup($redirect_url = ""){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'username', 'required|min_length[2]|is_unique[users.username]|trim|xss_clean');
		$this->form_validation->set_rules('password', 'password', 'required|matches[password1]|min_length[4]|xss_clean');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[users.email]|trim');
		$this->form_validation->set_message('is_unique', 'The %s already exists.');
		$this->form_validation->set_message('required', '*');
		if ($this->form_validation->run() == FALSE){
			$this->load->view('signup');
			return;
		} else{
			$data ['username'] = $this->input->post('username', true);
			$data ['password'] = $this->input->post('password', true);
			$data ['email'] = $this->input->post('email', true);
			$user = $this->User_model->insert($data);
			if (array_key_exists('error_message', $user)){
				$this->session->set_flashdata('message', 'Signup failed');
				$this->load->view('error_view');
				$this->session->unset_userdata('token');
				return;
			}
			// after signup is success..redirect if asked to or do nothing
			$this->session->set_flashdata('message', 'Signup complete');
			if ($redirect_url != ""){
				redirect($redirect_url, 'refresh');
			}
			return;
		}
	}

	function preferences(){
	}

	function index(){
	}

	function _get_session_token(){
		$token = $this->session->userdata('token');
		if ($token == false){
			return false;
		}
		return $token;
	}

	function _login_with_token($token, $redirect_url = ""){
		$user = $this->User_model->get_user_by_token($token);
		if (array_key_exists('error_message', $user)){
			$this->session->unset_userdata('token');
			$this->load->view('error_view', array (
					'error' => $user ));
			return;
		}
		$this->load->view('user/logout', array (
				'user' => $user ));
		if ($redirect_to = $this->input->post('redirect_url') != false){
			redirect($redirect_to, 'refresh');
		}
		return;
	}

	function _login_with_username_password($redirect_url = ""){
		$username = $this->input->post('username', true);
		$password = $this->input->post('password', true);
		$redirect_to = $this->input->post('redirect_url', true);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('redirect_url', 'Redirect Url', 'required');
		$this->form_validation->set_message('required', '*');
		if ($this->form_validation->run() == true){
			$user = $this->User_model->get_user($username, $password);
			if (array_key_exists('error_message', $user)){
				// go back to login
				$this->load->view('user/login_form', array (
						'redirect_url' => $redirect_url ));
				$this->session->unset_userdata('token');
				return;
			}
			// logged in..set session
			$this->load->view('user/logout', array (
					'user' => $user ));
			$this->session->set_userdata('token', $user->token);
			if ($redirect_to != false){
				redirect($redirect_to, 'refresh');
			}
			return;
		} else{
			$this->load->view('user/login_form', array (
					'redirect_url' => $redirect_url ));
			return;
		}
	}

	function login($redirect_after_success_url = ""){
		$token = $this->_get_session_token();
		if ($token != false){
			$this->_login_with_token($token, $redirect_after_success_url);
		} else{
			$this->_login_with_username_password($redirect_after_success_url);
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(site_url(), 'refresh');
	}
}