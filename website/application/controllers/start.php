<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

class Start extends MX_Controller {

	function __construct(){
		parent::__construct();
		// $this->output->enable_profiler(TRUE);
	}

	function index(){
		$token = Modules::run('user/_get_session_token');
		if ($token != false){
			redirect('member/index');
			return;
		}
		$data_start_view ['data_header'] = array (
				'title' => 'homepage' );
		$this->load->view('start_view', $data_start_view);
	}

	function about(){
		$data ['data_header'] = array (
				'title' => 'about' );
		
		$this->load->view('start_about_view', $data);
	}

	function contact(){
		$data ['data_header'] = array (
				'title' => 'contact' );
		$this->load->view('start_contact_view', $data);
	}
}
