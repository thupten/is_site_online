<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

class User extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('User_model');
		$this->load->library('form_validation');
		$this->form_validation->CI = & $this;
		$this->template->set_layout('one_col');
		$this->template->set_partial('header', 'site/blocks/header');
		$this->template->set_partial('footer', 'site/blocks/footer');
	}

	function delete_profile($redirect_uri = ""){
		$where ['token'] = $this->session->userdata('token');
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
		$this->form_validation->set_rules('email', 'email', 'valid_email|trim|xss_clean');
		$this->form_validation->set_rules('email_alert', 'email alert', 'xss_clean');
		$this->form_validation->set_rules('email_promo', 'email alert', 'xss_clean');
		$token = $this->session->userdata('token');
		if ($token == false){
			$this->session->set_flashdata('message', 'Session expired');
			redirect('site/login');
			return;
		}
		if ($this->form_validation->run() == FALSE){
			$user = $this->User_model->get_user_by_token($token);
			if (array_key_exists('error_message', $users)){
				$this->session->set_flashdata('message', 'Session expired');
				redirect('site/login');
				return;
			}
			$this->template->build('edit_profile', array (
					'user' => $user ));
			return;
		} else{
			// validation is true
			$data ['token'] = $this->session->userdata('token');
			$data ['email'] = $this->input->post('email', true);
			$data ['email_alert'] = $this->input->post('email_alert', true);
			$data ['email_promo'] = $this->input->post('email_promo', true);
			$user = $this->User_model->update($data);
			if (isset($user->error_message)){
				$this->load->view('error_view', array (
						'error' => $user ));
				$this->session->unset_userdata('token');
				return;
			} else{
				$this->session->set_flashdata('message', 'Update complete');
				$this->session->set_userdata('token', $user->token);
				redirect('user/edit_profile', 'refresh');
				return;
			}
		}
	}

	function change_password(){
		$token = $this->session->userdata('token');
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('old_password', 'old password', 'trim|required');
		$this->form_validation->set_rules('new_password', 'new password', 'trim|matches[new_password1]|required');
		$this->form_validation->set_rules('new_password1', 'new password', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			// show the form
			$user = ($token == false) ? NULL : $this->User_model->get_user_by_token($token);
			$this->template->build('change_password_view', $user);
		} else{
			// get the values and make request to change the password to the api
			$username = $this->input->post('username');
			$old_password = $this->input->post('old_password');
			$new_password = $this->input->post('new_password');
			$response = $this->User_model->change_password($username, $old_password, $new_password);
			var_dump($response);
			if (is_array($response) && array_key_exists('error_message', $response)){
				$this->session->set_flashdata('message', 'Could not change password');
				$this->template->build('change_password_view');
			} else if (is_object($response) && isset($response->error_message)){
				$this->session->set_flashdata('message', 'Could not change password');
				$this->template->build('change_password_view');
			} else{
				$this->session->set_flashdata('message', 'Password changed');
				redirect('user/logout');
			}
		}
	}
	// get
	function signup($redirect_uri = ""){
		$this->form_validation->set_rules('password', 'password', 'trim|required|matches[password1]');
		$this->form_validation->set_rules('password1', 'password', 'trim');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
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
				$this->session->set_flashdata('message', 'invalid user or password');
				redirect('site/login', 'refresh');
			}
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
		$token = $this->_get_session_token();
		$this->User_model->logout($token);
		$this->session->unset_userdata('token');
		$this->session->keep_flashdata('message');
		redirect(site_url('site/login'), 'refresh');
	}
}