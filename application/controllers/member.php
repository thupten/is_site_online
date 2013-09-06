<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');
class Member extends MX_Controller {

	function __construct() {
		parent::__construct();
		// $this->output->enable_profiler(TRUE);
	}

	function index() {
		$username = Modules::run('user/_get_session_username');
		if ($username == false) {
			redirect('start/index');
			return;
		}
		
		$data['run_a_quick_check_module'] = Modules::run('quick_check/get_run_quick_check_form');
		$data['data_header'] = array (
				'title' => 'homepage',
				'login_form_module' => Modules::run('user/login') 
		);
		$data['data_member_page'] = array (
				'main' => Modules::run('projects/get_projects'),
				'sidebar' => $this->load->view('sidebar','',true) 
		);
		
		$this->load->view('member_view', $data);
	}
}
