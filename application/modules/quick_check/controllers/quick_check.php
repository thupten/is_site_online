<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');
class Quick_check extends MX_Controller {
	// business logic goes to model. don't put business logic in controller
	function __construct() {
		parent::__construct();
		$this->load->model('Quick_check_model');
	}

	function get_recently_checked_sites($qty) {
		$data['rows'] = $this->Quick_check_model->get_publicly_checked_project($qty);
		$this->load->view('quick_check_result', $data);
	}

	function get_run_quick_check_form() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('url', 'url', 'trim|required|prep_url|xss_clean');
		if ($this->form_validation->run() == false) {
			$this->load->view('quick_check_form');
		} else {
			$url = $this->input->get_post('url', true);
			// pass to model to work with checking and updating db and getting status
			$data['rows'] = $this->Quick_check_model->check_this_url($url);
			// return check output
			$this->load->view('quick_check_result', $data);
		}
	}
}