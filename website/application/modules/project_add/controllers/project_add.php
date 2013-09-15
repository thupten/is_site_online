<?php

if (! defined('BASEPATH'))
	exit('No direct script access allowed');
class Project_add extends MX_Controller {
	// business logic goes to model. don't put business logic in controller
	function __construct() {
		parent::__construct();
		// add more here
	}

	function index($redirect="") {
		$data = array();
		$this->load->view("add_new_project_button");
	}
}