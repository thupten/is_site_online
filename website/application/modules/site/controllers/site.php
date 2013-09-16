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
		$recently_checked_html = Modules::run('services/get_recently_checked_sites',5);
		$this->template->inject_partial('box2',$recently_checked_html);
		$quick_check_form_html = Modules::run('services/get_run_quick_check_form');
		$this->template->inject_partial('box3',$quick_check_form_html);
		$this->template->build('site_homepage_view');
	}

	function about(){
		$this->template->build('site_about_view');
	}

	function contact(){
		$this->template->build('site_contact_view');
	}
}
