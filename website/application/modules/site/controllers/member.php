<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');
class Member extends MX_Controller {

	function __construct() {
		parent::__construct();
		// $this->output->enable_profiler(TRUE);
	}

	function index() {
		$token = Modules::run('user/_get_session_token');
		if ($token == false) {
			redirect('start/index');
			return;
		}
		
		$data['data_header'] = array (
				'title' => 'member'
		);
		$this->load->view('member_view', $data);
	}
}
