<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

class Start extends MX_Controller {

	function __construct(){
		parent::__construct();
		//$this->output->enable_profiler(TRUE);
	}

	function index(){
		$data_start_view ['data_header'] = array (
				'title' => 'homepage' );
		$this->load->view('start_view', $data_start_view);
	}

	function about(){
		$this->template->title('about');
		$this->template->set_theme('default_theme');
		$this->template->set_layout('one_col');
		$this->template->set_partial('header','blocks/header');
		$this->template->set_partial('footer','blocks/footer');
		$this->template->build('start_about_view');
		//$this->load->view('start_about_view', $data);
	}

	function contact(){
		$data ['data_header'] = array (
				'title' => 'contact' );
		$this->load->view('start_contact_view', $data)
		;
	}
}
