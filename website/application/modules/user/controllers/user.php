<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

class User extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('User_model');
		$this->load->library('form_validation');
		$this->form_validation->CI = & $this;
	}

	function delete_profile($redirect_uri = ""){
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
		if ($redirect_uri != ""){
			redirect($redirect_uri, 'refresh');
		}
	}

	function edit_profile($redirect_uri = ""){
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
			if ($redirect_uri != ""){
				redirect($redirect_uri, 'refresh');
			}
			return;
		}
	}
	// get
	function signup($redirect_uri = ""){
		$this->form_validation->set_rules('password', 'password', 'trim|required|password|matches[password1]');
		$this->form_validation->set_rules('password1', 'password', 'trim');
		$this->form_validation->set_rules('email', 'email', 'trim');
		$this->form_validation->set_rules('username', 'username', 'trim|required|is_unique[users.username]|xss_clean');
		$this->form_validation->set_message('is_unique', 'The %s already exists.');
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
			$this->session->set_flashdata('message', 'Signed up successfully');
			if ($redirect_uri != ""){
				redirect($redirect_uri, 'refresh');
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

	function _login_with_token($token, $redirect_uri = ""){
		$user = $this->User_model->get_user_by_token($token);
		if (array_key_exists('error_message', $user)){
			$this->session->unset_userdata('token');
			$this->load->view('error_view', array (
					'error' => $user ));
			return;
		}
		$this->load->view('user/logout', array (
				'user' => $user ));
		if ($redirect_to = $this->input->post('redirect_uri') != false){
			redirect($redirect_to, 'refresh');
		}
		return;
	}

	function _login_with_username_password($redirect_uri = ""){
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('redirect_uri', 'Redirect Url', 'trim');
		if ($this->form_validation->run() == true){
			$username = $this->input->post('username', true);
			$password = $this->input->post('password', true);
			$redirect_to = $this->input->post('redirect_uri', true);
			$user = $this->User_model->get_user($username, $password);
			if (array_key_exists('error_message', $user)){
				// go back to login
				$this->session->unset_userdata('token');
				redirect('site/login');
			}
			// logged in..set session
			// $this->load->view('user/logout', array (
			// 'user' => $user ));
			$this->session->set_userdata('token', $user->token);
			if ($redirect_to != false){
				redirect($redirect_to, 'refresh');
			}
			return;
		} else{
			$this->load->view('login_block', array (
					'redirect_uri' => $redirect_uri ));
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

	function dashboard(){
		$token = $this->_get_session_token();
		if ($token == false){
			$this->load->view('user/dashboard');
		} else{
			$data ['user'] = $this->User_model->get_user_by_token($token);
			$this->load->view('user/dashboard', $data);
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(site_url(), 'refresh');
	}
}