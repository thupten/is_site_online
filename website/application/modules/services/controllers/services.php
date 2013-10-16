<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

class Services extends MX_Controller {
	// business logic goes to model. don't put business logic in controller
	function __construct(){
		parent::__construct();
		$this->load->model('Quick_check_model');
	}

	function get_recently_checked_sites($qty){
		$data ['rows'] = $this->Quick_check_model->get_publicly_checked_project($qty);
		return $this->load->view('quick_check_result', $data, true);
	}

	function get_run_quick_check_form($url=false){
		$this->load->library('form_validation');
		$this->form_validation->CI = & $this;
		$this->form_validation->set_rules('url', 'url', 'trim|required|prep_url|xss_clean');
		if ($this->form_validation->run() == false || $url==false){
			$this->load->view('quick_check_form', array (
					'rows' => null ));
		} else{
			if(strpos($url,'http') === false){
				$url = 'http://'.$url;
			}
			$response_array = $this->Quick_check_model->check_this_url($url);
			if(is_array($response_array) and count($response_array)>0){
				$response = $response_array[0];
				if($response->status ==200){
					$this->session->set_userdata('check_status', $response->url.'&nbsp;&nbsp;&nbsp;  <i class="icon-thumbs-up"></i> <span class="text-success">GOOD</span>');
				}else{
					$this->session->set_userdata('check_status', $response->url.'&nbsp;&nbsp;&nbsp;  <i class="icon-thumbs-up"></i> <span class="text-danger">BAD</span>');
				}
			}
			redirect(site_url());
		}
	}
}
