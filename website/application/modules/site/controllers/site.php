<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

class Site extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->template->set_layout('one_col');
		$this->template->set_partial('header', 'blocks/header');
		$this->template->set_partial('footer', 'blocks/footer');
	}

	function index(){
		$recently_checked_html = Modules::run('services/get_recently_checked_sites', 5);
		$this->template->inject_partial('box2', $recently_checked_html);
		$url = $this->input->get_post('url');
		if($url !=false){
			$quick_check_form_html = Modules::run('services/get_run_quick_check_form', $url);
		}else{
			$quick_check_form_html = Modules::run('services/get_run_quick_check_form');
		}
		$this->template->inject_partial('box3', $quick_check_form_html);
		$this->template->title('very useful info - get notified if your site is down');
		$this->template->build('site_homepage_view');
	}

	function signup(){
		$data ['redirect_uri'] = site_url('site/login');
		$this->template->title('very useful info - get notified if your site is down - free sign up');
		$this->template->build('site_signup_view', $data);
	}

	function login(){
		$token = $this->session->userdata('token');
		if($token != false){
			redirect('projects/index');
		}
		$data ['redirect_uri'] = site_url('projects/index');
		$this->template->title('very useful info - get notified if your site is down - login');
		$this->template->build('site_login_view', $data);
	}

	function about(){
		$this->template->title('about  very useful info - check if a site is down or not');
		$this->template->build('site_about_view');
	}
}
