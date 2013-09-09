<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');
class Start extends MX_Controller {

	function __construct() {
		parent::__construct();
		// $this->output->enable_profiler(TRUE);
	}

	function index() {
		$username = Modules::run('user/_get_session_username');
		if ($username != false) {
			redirect('member/index');
			return;
		}
		$data['data_header'] = array (
				'title' => 'homepage',
		);
		$data['data_homepage'] = array (
				'main' => "",
				'sidebar' => "" 
		);
		$this->load->view('start_view', $data);
	}

	function about() {
		$data['data_header'] = array (
				'title' => 'homepage',
				'login_form_module' => Modules::run('user/login') 
		);
		
		$this->load->view('start_about_view');
	}

	function contact() {
		$this->load->view('start_contact_view');
	}
}
