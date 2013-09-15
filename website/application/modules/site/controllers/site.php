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
		$this->template->build('site_homepage_view');
	}

	function about(){
		$this->template->build('site_about_view');
	}

	function contact(){
		$this->template->build('site_contact_view');
	}
}
